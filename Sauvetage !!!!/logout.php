<?php
session_start();
session_unset();
session_destroy();
setcookie("email","",time()-1);
setcookie("username","",time()-1);
header("location:login.php");
?>