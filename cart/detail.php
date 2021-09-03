<?php
session_start();
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
    $url = "https://";   
} else  {
        $url = "http://";
    }
    $url.= $_SERVER['HTTP_HOST'];  
    $url.= $_SERVER['REQUEST_URI'];   
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $idOrder = $params['id'];
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
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h1 class="heading-section">Order Detail</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('../connect_db.php');
                            $total = 0;
                            $totalTemp = 0;
                            $amount = 0;
                            if(isset($_SESSION['fullName'])){
                                  ['getOrderDetail' => $func] = require 'order.php';
                                  $order = $func($conn,$idOrder,$_SESSION['customerID']);
                                  for($i=0;$i<count($order);$i++) {
                                    $price = intval($order[$i]['Price']);
                                    $price1 =  number_format($price, 0, '', '.');   
                                    $amount += $order[$i]['Quantity'];                 
                                    echo "<tr class=\"alert\" role=\"alert\">
                                    <td>".$order[$i]['OrderID']."</td>
                                    <td>
                                        <div class=\"img\" style=\"background-image: url('".$order[$i]['Image']."');\"></div>
                                    </td>
                                  <td>
                                      <div class=\"email\">
                                          <span>".$order[$i]['VegetableName']."</span>
                                          <span</span>
                                      </div>
                                  </td>
                                  <td>".$price1." VND</td>
                                  <td class=\"quantity\">
                                    <div class=\"input-group\">
                                     <input type=\"text\" name=\"quantity\" class=\"quantity form-control input-number\" value=\"".$order[$i]['Quantity']."\" min=\"1\" max=\"100\" disabled>
                                  </div>
                              </td>
                                </tr>	";
                                }
                                $totalTemp = intval($order[0]['Total']);
                                $total = number_format($totalTemp, 0, '', '.');   
                                echo "<thead class=\"thead-primary\"><tr class=\"alert\" role=\"alert\">
                                    <td></td>
                                    <td>
                                        <div class=\"img\"></div>
                                    </td>
                                  <td>
                                      <div class=\"email\">
                                          <span>Total :</span>
                                          <span</span>
                                      </div>
                                  </td>
                                  <td>".$total." VND</td>
                                  <td class=\"quantity\">
                                    <div class=\"input-group\">
                                    <input type=\"text\" name=\"quantity\" class=\"quantity form-control input-number\" value=\"".$amount."\" min=\"1\" max=\"100\" disabled>
                                    </div>
                              </td>
                                </tr>	</thead>";
                              }
                              require_once('../close_db.php');
                              ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>