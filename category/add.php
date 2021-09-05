<?php
    if(isset($_POST["nameCategory"])) {
        require '../class/category.php';
        require_once('../connect_db.php');
        $Categories = new Category($conn);
        $flag = $Categories->add(array($_POST["nameCategory"],$_POST["descriptionCategory"]));
        require_once('../close_db.php');
        if($flag) {
            echo "<script>alert('Đã thêm loại sản phẩm thành công !');location.reload();</script>";
        } else {
            echo "<script>alert('Đã có lỗi xảy ra khi thêm loại sản phẩm, vui lòng thử lại !');</script>";
        }
    }