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
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h1 class="heading-section">History Order</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('../connect_db.php');
                            if(isset($_SESSION['fullName'])){
                                  ['getAllOrder' => $func] = require 'order.php';
                                  $orders = $func($conn,$_SESSION['customerID']);
                                  for($i=0;$i<count($orders);$i++) {
                                    $price = intval($orders[$i]['Total']);
                                    $price1 =  number_format($price, 0, '', '.');                    
                                    echo "<tr class=\"alert\" role=\"alert\">
                                    <td>
                                        <div>".$orders[$i]['OrderID']."</div>
                                    </td>
                                  <td>
                                      <div>
                                          <span>".$orders[$i]['Date']."</span>
                                          <span</span>
                                      </div>
                                  </td>
                                  <td>".$price1." VND </td>
                                  <td>
                                  <button style=\"
                            background-color: rgb(28, 94, 194) !important;
                            color: #fff !important;
                        \" type=\"button\" class=\"btn bg-cart\"><a style=\"color: white;\" href=\"detail.php?id=".$orders[$i]['OrderID']."\">Detail</a></button>
                              </td>
                                </tr>	";
                                }
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