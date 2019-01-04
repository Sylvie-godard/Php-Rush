<?php
include_once("admin_product.php");
include_once("DB_connect.php");
include_once("admin_categorie.php");
include_once("admin_users.php");

$cat = new admin_users;
$result = $cat->set_admin($_GET['id']);
if($result){
    echo "vérifie base de donnée ma gueuleeee";
}
else{
    echo "tu peux réessayer sorry";
}
?>