<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["Uname"]);
header("Location:http://localhost/admin/login.php");
?>
