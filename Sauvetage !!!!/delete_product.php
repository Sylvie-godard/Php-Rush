<?php

include_once("admin_product.php");
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:login.php');
    exit;
}
if(!$_SESSION["admin"])
{
    header("location:index.php");
}
$delete_product= new Admin_product ();
$delete_product->delete_product($_GET['id']);
header("location:admin.php");
?>