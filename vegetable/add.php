<?php
if(isset($_POST["vegetableName"])) {
    $vegetableName = $_POST["vegetableName"];
    $categoryID = $_POST["categoryID"];
    $vegetableUnit = $_POST["vegetableUnit"];
    $vegetableAmount = $_POST["vegetableAmount"];
    $vegetablePrice = $_POST["vegetablePrice"];
    $image = "";
    
    if (isset($_FILES['vegetableFile'])){
        //upload file
        $file = $_FILES['vegetableFile'];
    
        $fileName = $_FILES['vegetableFile']['name'];
        $fileTmpName = $_FILES['vegetableFile']['tmp_name'];
        $fileSize = $_FILES['vegetableFile']['size'];
        $fileError = $_FILES['vegetableFile']['error'];
        $fileType = $_FILES['vegetableFile']['type'];
        
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg','png');
    
        if (in_array($fileActualExt,$allowed)) {
            if ($fileError === 0){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../images/'.$fileNameNew;
                $image = $image . "../images/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload file of this type !";
        }
    }
    $res = "";
    require_once('../connect_db.php');
    ['add' => $func] = require 'vegetable.php';
    $productCreate = $func($conn,array($categoryID,$vegetableName,$vegetableUnit,$vegetableAmount,$image,$vegetablePrice));
    require_once('../close_db.php');
    if($productCreate) {
        $res = "<script>alert('Đã thêm sản phẩm thành công !');location.reload();</script>";
    } else {
        $res = "<script>alert('Đã có lỗi xảy ra khi thêm sản phẩm, vui lòng thử lại !');</script>";
    }
    echo $res;
}