<?php
    session_start();
    $idCustomer = $_POST["idCustomer"];
    $res = "";
    require_once('../connect_db.php');
    if(isset($_SESSION['customerID'])){
        if(isset($_SESSION['cart'])){
            $total = 0;
            for($i=0;$i<count($_SESSION['cart']);$i++) {
                $total += $_SESSION['cart'][$i][2];
            }
            require '../class/order.php';
            $Orders = new Order($conn);
            $order = $Orders->addOrder(array($idCustomer,$total));
            if($order != -1){
                $Orders = new Order($conn);
                for($i=0;$i<count($_SESSION['cart']);$i++) {
                    $order2 = $Orders->addDetail(array($order,$_SESSION['cart'][$i][0],$_SESSION['cart'][$i][1],$_SESSION['cart'][$i][2]));
                    $decrease = $Orders->decreaseVegetable($_SESSION['cart'][$i][0],$_SESSION['cart'][$i][1]);
                }
                $res .= "<script>alert('Bạn đã mua hàng thành công !');location.reload();</script>";
                $_SESSION['cart'] = array();
            } else {
                $res .= "<script>alert('Đã có lỗi trong quá trình xác nhận đơn hàng, vui lòng thử lại !');</script>";
            }
        }
    } else {
        $res .= "<script>alert('Vui lòng đăng nhập tài khoản để mua hàng !');</script>";
    }
    require_once('../close_db.php');
    echo $res;
    
