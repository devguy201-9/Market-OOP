<?php
session_start();
    $res = "";
    require_once('../connect_db.php');
    $vegetableID = $_POST["vegetableID"];
    require '../class/order.php';
    $Orders = new Order($conn);
    $product = $Orders->checkAmount($vegetableID);
    $res = "";
    $amount2 = 1;
    $index = -1 ;
    if(isset($_SESSION['cart'])){
        if(count($_SESSION['cart']) != 0) {
            for($i=0;$i<count($_SESSION['cart']);$i++) {
                if($_SESSION['cart'][$i][0] == $product[0]['VegetableID']) {
                    $index = $i;
                    $amount2 += $_SESSION['cart'][$i][1];
                }
            }   
            if($index == -1) {
                if($product[0]['Amount'] != 0){
                     array_push($_SESSION['cart'],array($product[0]['VegetableID'],1,$product[0]['Price'],$product[0]['VegetableName'],$product[0]['Price'],$product[0]['Image']));
                     $res .= "<script>alert('Sản Phẩm đã được thêm vào giỏ !');</script>";
                } else{
                    $res .= "<script>alert('Sản phẩm hiện tại đã hết hàng, vui lòng chọn sản phẩm khác !');</script>";
                }
            } else {
                if($product[0]['Amount'] - $amount2 > 0) {
                    $_SESSION['cart'][$index][1] = $amount2;
                    $_SESSION['cart'][$index][2] = $amount2 * $product[0]['Price'];
                    $res .= "<script>alert('Sản Phẩm đã được thêm vào giỏ !');</script>";
                } else {
                    $res .= "<script>alert('Sản phẩm hiện tại đã hết hàng, vui lòng chọn sản phẩm khác !');</script>";
                }
            }
        } else {
            if($product[0]['Amount'] != 0){
                $_SESSION['cart'] = array();
                array_push($_SESSION['cart'],array($vegetableID,1,$product[0]['Price'],$product[0]['VegetableName'],$product[0]['Price'],$product[0]['Image']));
                $res .= "<script>alert('Sản Phẩm đã được thêm vào giỏ !');</script>";
            } else {
                $res .= "<script>alert('Sản phẩm hiện tại đã hết hàng, vui lòng chọn sản phẩm khác !');</script>";
            }
        }
    } else {
        if($product[0]['Amount'] != 0){
            $_SESSION['cart'] = array();
            array_push($_SESSION['cart'],array($vegetableID,1,$product[0]['Price'],$product[0]['VegetableName'],$product[0]['Price'],$product[0]['Image']));
            $res .= "<script>alert('Sản Phẩm đã được thêm vào giỏ !');</script>";
        } else {
            $res .= "<script>alert('Sản phẩm hiện tại đã hết hàng, vui lòng chọn sản phẩm khác !');</script>";
        }
    }
    require_once('../close_db.php');
    echo $res;
    // $_SESSION['cart'] = array();