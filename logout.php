<?php 
setcookie("userLoggedIn",null,time()-60*60*24*14);
header("location:login.php");

 ?>