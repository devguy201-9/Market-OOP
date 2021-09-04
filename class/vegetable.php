<?php
class Vegetable{
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getAll(){
        $query ="SELECT * FROM `vegetable`";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function getListByCateID($idCate){
        $query ="SELECT * FROM `vegetable` WHERE `CategoryID` = $idCate";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function getListByCateIDs($idCates){
        $ids = "(";
        foreach ($idCates as $value) {
            $ids .= $value . ",";
        }
        $ids = rtrim($ids, ", ");
        $ids .= ")";
        $query ="SELECT * FROM `vegetable` WHERE `CategoryID` in $ids";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function getByID($id){
        $query ="SELECT * FROM `vegetable` WHERE `VegetableID` = $id";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function add($vegetable){
        $query ="INSERT INTO `vegetable`(`CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`) VALUES  (".$vegetable[0].",\"".$vegetable[1]."\",\"".$vegetable[2]."\",".$vegetable[3].",\"".$vegetable[4]."\",".$vegetable[5].")";
        $result = mysqli_query($this->conn,$query);
        if(!$result) {
            return false;
        }
        return true;
    }
}