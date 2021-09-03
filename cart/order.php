<?php
    return [
        'getAllOrder' => function($conn,$cusID) {
            $query ="SELECT * FROM `order` WHERE `CustomerID` = $cusID";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'getOrderDetail' => function($conn, $orderID, $cusID) {
            $query ="SELECT * FROM `order` AS Orders INNER JOIN `orderdetail` AS detail ON Orders.OrderID = detail.OrderID INNER JOIN `vegetable` AS vegetable ON detail.VegetableID = vegetable.VegetableID  WHERE Orders.OrderID = $orderID AND Orders.CustomerID = $cusID";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'addOrder' => function($conn, $order) {
            $queryStr ="INSERT INTO `order`(`CustomerID`, `Date`, `Total`) VALUES (".$order[0].",\"".date("Y-m-d")."\",".$order[1].")";
            $id = -1;
            if (mysqli_query($conn, $queryStr)) {
                $last_id = mysqli_insert_id($conn);
                $id = $last_id;
              }
              return $id;
        },
        'addDetail' => function($conn, $detail) {
            $query ="INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) VALUES (".$detail[0].",".$detail[1].",".$detail[2].",".$detail[3].")";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'decreaseVegetable' => function($conn, $id,$amount) {
            $query ="UPDATE `vegetable` SET `Amount`= `Amount` - $amount WHERE `VegetableID` = $id";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        },
        'checkAmount' => function($conn, $idProduct) {
            $query ="SELECT * FROM `vegetable` WHERE `VegetableID` = $idProduct";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        }
    ];