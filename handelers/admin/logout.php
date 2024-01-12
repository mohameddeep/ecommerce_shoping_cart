<?php 
session_start();
unset($_SESSION['cart']);
session_destroy();


header("location:../../view/admin/admin_login.php");