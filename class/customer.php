<?php
class Customer{
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getByIDAndPassword($customer){
        $query ="SELECT * FROM `customers` WHERE `CustomerID` = $$customer[0] AND `Password` = \"$customer[1] \"";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
    }

    public function getByID($id){
        $query ="SELECT * FROM `customers` WHERE `CustomerID` = $id";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function add($customer){
        $query ="INSERT INTO `customers`(`Password`, `Fullname`, `Address`, `City`) VALUES (\"".$customer[0]."\",\"".$customer[1]."\",\"".$customer[2]."\",\"".$customer[3]."\")";
        $result = mysqli_query($this->conn,$query);
        if(!$result) {
            return false;
        }
        return true;
    }
}