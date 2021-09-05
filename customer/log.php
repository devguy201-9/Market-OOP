<?php
    session_start();
    $res = "";
    require_once('../connect_db.php');
    if(isset($_POST["idCustomer"])){
        $idCustomer = $_POST["idCustomer"];
        $PasswordCustomer = $_POST["PasswordCustomer"];
        require '../class/customer.php';
        $CustomerLogin = new Customer($conn);
        $customer = $CustomerLogin->getByIDAndPassword(array($idCustomer,$PasswordCustomer));

        if(!empty($customer)) {
            $_SESSION['customerID']=$customer[0][0];
            $_SESSION['fullName']=$customer[0][2];
            echo "<script>window.location.replace((window.location.href).split('/').slice(0, -1).join('/') + '/index.php');</script>";
        } else {
            echo "<script>alert('Không tìm thấy tài khoản !');</script>";
        }
    } else if(isset($_POST["fullNameCustomer"])) {
        $fullNameCustomer = $_POST["fullNameCustomer"];
        $passwordCustomer = $_POST["passwordCustomer"];
        $addressCustomer = $_POST["addressCustomer"];
        $cityCustomer = $_POST["cityCustomer"];
        require '../class/customer.php';
        $CustomerNew = new Customer($conn);
        $customer = $CustomerNew->add(array($passwordCustomer,$fullNameCustomer,$addressCustomer,$cityCustomer));
        if($customer) {
            echo "<script>alert('Bạn đã đăng ký tài khoản thành công, vui lòng đăng nhập tài khoản !');window.location.replace((window.location.href).split('/').slice(0, -1).join('/') + '/login.php');</script>";
        } else {
            echo "<script>alert('Đã có lỗi xảy ra khi đăng ký tài khoản, vui lòng thử lại !');</script>";
        }
    }
    require_once('../close_db.php');
    