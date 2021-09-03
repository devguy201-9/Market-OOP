<?php
    return [
        'getByID' => function($conn, $id) {
            $query ="SELECT * FROM `customers` WHERE `CustomerID` = $id";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'add' => function($conn, $customer) {
            $query ="INSERT INTO `customers`(`Password`, `Fullname`, `Address`, `City`) VALUES (\"".$customer[0]."\",\"".$customer[1]."\",\"".$customer[2]."\",\"".$customer[3]."\")";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'getByIDAndPassword' => function($conn, $id,$password) {
            $query ="SELECT * FROM `customers` WHERE `CustomerID` = $id AND `Password` = \"$password \"";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        }
    ];