<?php
session_start();
unset($_SESSION['customerID']);
unset($_SESSION['fullName']);
echo "<script>window.location.replace((window.location.href).split('/').slice(0, -1).join('/') + '/index.php');</script>";