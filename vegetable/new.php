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
<h2 style="text-align: center;">Add vegetable</h2>
<br>
    <div style="width:50%; margin-left:25%;">
        <form id="id-form-add-vegetable" method="POST" action="" enctype="multipart/form-data">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4" style="width: 100%;margin-left: 10px;">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example1">Vegetable name :</label>
                        <input type="text" id="form3Example1" class="form-control" required="" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="inputGroupSelect02">Category name :</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="inputGroupSelect02">
                                <?php
              require '../class/category.php';
              require_once('../connect_db.php');
              $Categories = new Category($conn);
              $categories = $Categories->getAll();
              require_once('../close_db.php');
              for($i=0;$i<count($categories);$i++) {
                echo "<option value=\"".$categories[$i]['CategoryID']."\">".$categories[$i]['Name']."</option>";
              }
              ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mb-4" style="width: 100%;margin-left: 10px;">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example12">Unit :</label>
                        <input type="text" id="form3Example12" class="form-control" required="" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example22">Amount :</label>
                        <input type="number" id="form3Example22" class="form-control" required="" />
                    </div>
                </div>
            </div>
            <div class="row mb-4" style="width: 100%;margin-left: 10px;">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example13">Price :</label>
                        <input type="number" id="form3Example13" class="form-control" required="" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="inputGroupFile02">Image :</label>
                        <!-- <input type="file" id="form3Example2" class="form-control" required="" accept=".jpg,.png"  onchange="validateFileType()"/> -->
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" required=""
                                    accept=".jpg,.png" onchange="changeLabelFile()" />
                                <label class="custom-file-label" for="inputGroupFile02" id="labelFile">Choose
                                    file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button style="margin-left: 20px;" type="submit" class="btn bg-cart2" id="btnAddVegetable">Add</button>


        </form>

    </div>


    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
    <script>
    $("#id-form-add-vegetable").submit(function(event) {
        var fileName = document.getElementById("inputGroupFile02").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile == "jpg" || extFile == "png") {
            const fi = document.getElementById('inputGroupFile02');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (let i = 0; i <= fi.files.length - 1; i++) {

                    let fsize = fi.files.item(i).size;
                    let file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file > 2048) {
                        alert(
                            "File too Big, please select a file less or equal 2mb");
                    } else {
                        event.preventDefault(); //prevent default action 
                        var fd = new FormData();
                        var files = $('#inputGroupFile02')[0].files;
                        fd.append('vegetableFile', files[0]);
                        fd.append('vegetableName', $("#form3Example1").val());
                        fd.append('categoryID', $("#inputGroupSelect02").val());
                        fd.append('vegetableUnit', $("#form3Example12").val());
                        fd.append('vegetableAmount', $("#form3Example22").val());
                        fd.append('vegetablePrice', $("#form3Example13").val());

                        $.ajax({
                            url: "add.php",
                            type: 'POST',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $("#Result").html(response);
                            },
                        });

                    }
                }
            }
        } else {
            alert("Only jpg/jpeg and png files are allowed!");
        }

    });

    function changeLabelFile() {
        var fullPath = document.getElementById('inputGroupFile02').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            document.getElementById("labelFile").innerHTML = filename;
        }
    }
    </script>
</body>

</html>