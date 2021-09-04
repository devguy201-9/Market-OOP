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
    <div style="display: flex;">
        <div style="width:40%;">
            <form id="id-form-add-category" method="POST" action="">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4" style="width: 100%;margin-left: 10px;">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Name :</label>
                            <input type="text" id="form3Example1" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example2">Description :</label>
                            <input type="text" id="form3Example2" class="form-control" required=""/>
                        </div>
                    </div>
                </div>
                <button style="margin-left: 20px;" type="submit" class="btn bg-cart2" id="btnAddCategory">Add</button>


            </form>
        </div>
        <div style="width:55%;margin-left:5%;">
            <h1>Category</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
              require '../class/category.php';
              require_once('../connect_db.php');
              $Categories = new Category($conn);
              $categories = $Categories->getAll();
              require_once('../close_db.php');
              for($i=0;$i<count($categories);$i++) {
                echo "<tr>
                <th scope=\"row\">".$categories[$i]['CategoryID']."</th>
                <td>".$categories[$i]['Name']."</td>
                <td>".$categories[$i]['Description']."</td>
              </tr>";
              }
                  ?>

                </tbody>
            </table>
        </div>
    </div>


    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $("#id-form-add-category").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                $.post("add.php", {
                  nameCategory: $("#form3Example1").val(),
                  descriptionCategory: $("#form3Example2").val()
                }, function(data) {
                    $("#Result").html(data);
                });
            });
    </script>
</body>

</html>