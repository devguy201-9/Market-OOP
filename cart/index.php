<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/style3.css">
    <link rel="stylesheet" href="../css/stylevegetable.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php
  include '../menu2.php'
?>
    <div id="Result"></div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h1 class="heading-section">Your Cart</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              if(isset($_SESSION['cart'])){
                                  for($i=0;$i<count($_SESSION['cart']);$i++) {
                                    $price = intval($_SESSION['cart'][$i][2]);
                                    $price1 =  number_format($price, 0, '', '.');                    
                                    $price2 = intval($_SESSION['cart'][$i][4]);
                                    $price3 =  number_format($price2, 0, '', '.');                    
                                    echo "<tr class=\"alert\" role=\"alert\">
                                    <td>
                                        <div class=\"img\" style=\"background-image: url('".$_SESSION['cart'][$i][5]."');\"></div>
                                    </td>
                                  <td>
                                      <div class=\"email\">
                                          <span>".$_SESSION['cart'][$i][3]."</span>
                                          <span</span>
                                      </div>
                                  </td>
                                  <td>".$price3." VND</td>
                                  <td class=\"quantity\">
                                    <div class=\"input-group\">
                                     <input type=\"text\" name=\"quantity\" class=\"quantity form-control input-number\" value=\"".$_SESSION['cart'][$i][1]."\" min=\"1\" max=\"100\" disabled>
                                  </div>
                              </td>
                              <td>".$price1."VND </td>
                                </tr>	";
                                }
                              }
                              ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <?php
                        $money = 0;
                        $moneyTemp = 0;
                        if(isset($_SESSION['cart'])){
                            for($i=0;$i<count($_SESSION['cart']);$i++) {
                                $moneyTemp += $_SESSION['cart'][$i][2];
                            }
                            $price = intval($moneyTemp);
                            $money =  number_format($price, 0, '', '.');    
                        }
                        if($money != 0) {
                            echo "<h3 class=\"heading-section\">Total price: ".$money." VND</h3><br><button style=\"
                            background-color: rgb(202, 20, 44) !important;
                            color: #fff !important;
                        \" type=\"button\" class=\"btn bg-cart\" onclick=\"order()\"><i
                        class=\"fa fa-cart-plus mr-2\"></i>Order</button>";
                        } else {
                            echo "<h3 class=\"heading-section\">Total price: ".$money." VND</h3>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <form id="id-form-order" method="POST" action="">
            <?php if(isset($_SESSION['customerID'])){
                echo "<input type=\"hidden\" id=\"idCustomer\" name=\"idCustomer\" value=\"".$_SESSION['customerID']."\">";
            } else {
                echo "<input type=\"hidden\" id=\"idCustomer\" name=\"idCustomer\" value=\"\">";
            } ?>
            <button type="submit" id="btnOrder" style="display:none;"></button>
        </form>
    </section>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
</body>
<script>
$("#id-form-order").submit(function(event) {
    event.preventDefault(); //prevent default action 
    var post_url = $(this).attr("action"); //get form action url
    $.post("saveorder.php", {
        idCustomer: $("#idCustomer").val()
    }, function(data) {
        $("#Result").html(data);
    });
});

function order() {
    $("#btnOrder").click();
}
</script>

</html>