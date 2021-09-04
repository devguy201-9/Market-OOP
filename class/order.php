<?php
class Order{
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getAllOrder($cusID){
        $query ="SELECT * FROM `order` WHERE `CustomerID` = $cusID";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function getOrderDetail($orderID, $cusID){
        $query ="SELECT * FROM `order` AS Orders INNER JOIN `orderdetail` AS detail ON Orders.OrderID = detail.OrderID INNER JOIN `vegetable` AS vegetable ON detail.VegetableID = vegetable.VegetableID  WHERE Orders.OrderID = $orderID AND Orders.CustomerID = $cusID";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function addOrder($order){
        $queryStr ="INSERT INTO `order`(`CustomerID`, `Date`, `Total`) VALUES (".$order[0].",\"".date("Y-m-d")."\",".$order[1].")";
        $id = -1;
        if (mysqli_query($this->conn, $queryStr)) {
            $last_id = mysqli_insert_id($this->conn);
            $id = $last_id;
        }
        return $id;
    }

    public function addDetail($detail){
        $query ="INSERT INTO `orderdetail`(`OrderID`, `VegetableID`, `Quantity`, `Price`) VALUES (".$detail[0].",".$detail[1].",".$detail[2].",".$detail[3].")";
        $result = mysqli_query($this->conn,$query);
        if(!$result) {
            return false;
        }
        return true;
    }

    public function decreaseVegetable($id,$amount){
        $query ="UPDATE `vegetable` SET `Amount`= `Amount` - $amount WHERE `VegetableID` = $id";
        $result = mysqli_query($this->conn,$query);
        if(!$result) {
            return false;
        }
        return true;
    }

    public function checkAmount($idProduct){
        $query ="SELECT * FROM `vegetable` WHERE `VegetableID` = $idProduct";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }
}