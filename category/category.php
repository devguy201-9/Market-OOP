<?php
    return [
        'getAll' => function($conn) {
            $query ="SELECT * FROM `category`";
            $result = mysqli_query($conn,$query);
            $data = array();
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
        },
        'add' => function($conn, $category) {
            $query ="INSERT INTO `category`(`Name`, `Description`) VALUES (\"".$category[0]."\",\"".$category[1]."\")";
            $result = mysqli_query($conn,$query);
            if(!$result) {
                return false;
            }
            return true;
        }
    ];