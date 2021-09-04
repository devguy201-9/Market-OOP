<?php
class Category{
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getAll(){
        $query ="SELECT * FROM `category`";
        $result = mysqli_query($this->conn,$query);
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        return $data;
    }

    public function add($category){
        $query ="INSERT INTO `category`(`Name`, `Description`) VALUES (\"".$category[0]."\",\"".$category[1]."\")";
        $result = mysqli_query($this->conn,$query);
        if(!$result) {
            return false;
        }
        return true;
    }
}