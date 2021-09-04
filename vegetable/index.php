<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Style -->
    <link rel="stylesheet" href="../css/stylevegetable.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Market website</title>
</head>

<body>
  <div id="Result"></div>
  <?php
  include '../menu2.php'
?>
    <div style="display: flex;width: 100%;">
        <div style="width: 15%;margin-top: 10%;margin-left: 20px;">
            <form id="id-form-filter" method="POST" action="">
                <h3>Category Name:</h3>
                <!-- Default checkbox -->
                <?php
             require '../class/category.php';
             require_once('../connect_db.php');
             $Categories = new Category($conn);
             $categories = $Categories->getAll();
              $res2 = "";
              for($i=0;$i<count($categories);$i++) {
                $res2 .= "<div class=\"form-check\">
                <input class=\"form-check-input\" type=\"checkbox\" value=\"".$categories[$i]['CategoryID']."\" id=\"flexCheckDefault".$categories[$i]['CategoryID']."\" />
                <label class=\"form-check-label\" for=\"flexCheckDefault".$categories[$i]['CategoryID']."\">
                    ".$categories[$i]['Name']."
                </label>
            </div>";
              }
          echo $res2;
        ?>
                <br>
                <button type="submit" class="btn bg-cart2" id="btnFilter">Filter</button>
            </form>
        </div>
            
        <div style="width: 90%;margin-left: -10%;">
            <h1 style="text-align: center">Vegetable</h1>
            <div class="container d-flex justify-content-center mt-50 mb-50">
                <div class="row" id="products">
                    <?php
              require '../class/vegetable.php';
        $Vegetables = new Vegetable($conn);
        $vegetables = $Vegetables->getAll();
              require_once('../close_db.php');
              $res = "";
              for($i=0;$i<count($vegetables);$i++) {
                $price = intval($vegetables[$i]['Price']);
                $price1 =  number_format($price, 0, '', '.');
                $res .= "<div class=\"col-md-4 mt-2\">
                <div class=\"card\" style=\"width:350px;height:456px;margin-right:370px;\">
                    <div class=\"card-body\" style=\"width:350px;height:300px;\">
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
        ?>
                </div>
            </div>
        </div>
    </div>
    <form id="id-form-buy" method="POST" action="">
      <input type="hidden" id="vegetableID" name="vegetableID" value="">
      <button type="submit" id="btnFormBuy" style="display:none;"></button>
            </form>
              
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
    <script>
      function buyProduct(idProduct){
        $("#vegetableID").val(idProduct);
        $("#btnFormBuy").click();
      }
    $("#id-form-filter").submit(function(event) {
        event.preventDefault(); //prevent default action 
        var post_url = $(this).attr("action"); //get form action url
        const filters = [];
        $(":checkbox").each(function() {
            var ischecked = $(this).is(":checked");
            if (ischecked) {
                filters.push($(this).val());
            }
        });
        // alert(filters);
        if (filters.length != 0) {
            $.post("filter.php", {
                filterIDs: filters
            }, function(data) {
                $("#products").html(data);
            });
        } else {
            alert('Bạn chưa chọn loại để filter');
        }

    });
    $("#id-form-buy").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                var value = $("#vegetableID").val();
                $.post("../cart/cart.php", {
                  vegetableID: $("#vegetableID").val()
                }, function(data) {
                    $("#Result").html(data);
                });
            });
    </script>
</body>

</html>