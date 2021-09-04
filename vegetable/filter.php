<?php
    $res = "";
    require_once('../connect_db.php');
    $filterIDs = $_POST["filterIDs"];
    require '../class/vegetable.php';
        $Vegetables = new Vegetable($conn);
        $vegetables = $Vegetables->getListByCateIDs($filterIDs);
    $res = "";
              for($i=0;$i<count($vegetables);$i++) {
                $price = intval($vegetables[$i]['Price']);
                $price1 =  number_format($price, 0, '', '.');
                $res .= "<div class=\"col-md-4 mt-2\">
                <div class=\"card\" style=\"width:350px;height:456px;margin-right:370px;\">
                    <div class=\"card-body\"  style=\"width:350px;height:300px;\">
                        <div class=\"card-img-actions\"> <img
                        src=\"".$vegetables[$i]['Image']."\"
                        class=\"card-img img-fluid\" style=\"width:350px;height:290px;\" alt=\"Không tìm thấy ảnh !\"> </div>
                        </div>
                    <div class=\"card-body bg-light text-center\">
                        <div class=\"mb-2\">
                            <h6 class=\"font-weight-semibold mb-2\"> <a href=\"#\" class=\"text-default mb-2\"
                                    data-abc=\"true\">".$vegetables[$i]['VegetableName']."</a> </h6>
                        </div>
                        <h3 class=\"mb-0 font-weight-semibold\">".$price1." VND"."</h3>
                        <div class=\"text-muted mb-3\"></div> <button type=\"button\" onclick=\"buyProduct(".$vegetables[$i]['VegetableID'].")\" class=\"btn bg-cart\"><i
                                class=\"fa fa-cart-plus mr-2\"></i>Buy</button>
                    </div>
                </div>
            </div>";
              }
          echo $res;
    require_once('../close_db.php');
    
