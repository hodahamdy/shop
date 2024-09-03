<?php  


session_start();


if (isset($_POST['remove'])){ 


    $id =$_GET['id'];

    unset ($_SESSION['carts'][$id]);

    header("location:cart.php");
}