<?php
    return [
        'getAll' => function($conn) {
            $query ="SELECT * FROM `vegetable`";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'getListByCateID' => function($conn, $idCate) {
            $query ="SELECT * FROM `vegetable` WHERE `CategoryID` = $idCate";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'getListByCateIDs' => function($conn, $idCates) {
            $ids = "(";
            foreach ($idCates as $value) {
                $ids .= $value . ",";
            }
            $ids = rtrim($ids, ", ");
            $ids .= ")";
            $query ="SELECT * FROM `vegetable` WHERE `CategoryID` in $ids";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'getByID' => function($conn, $id) {
            $query ="SELECT * FROM `vegetable` WHERE `VegetableID` = $id";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'add' => function($conn, $vegetable) {
            $query ="INSERT INTO `vegetable`(`CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`) VALUES  (".$vegetable[0].",\"".$vegetable[1]."\",\"".$vegetable[2]."\",".$vegetable[3].",\"".$vegetable[4]."\",".$vegetable[5].")";
            echo $query;
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        }
    ];