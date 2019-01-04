<?php
include_once("admin_users.php");
include_once("admin_categorie.php");
include_once("admin_product.php");


$admin = new admin_users;
$product = new admin_product;

// $admin->delete_users("MevJer");
// $admin->exist_email("loszdxclo@lolo.com");
// $admin->create_users("ade", "ader", "ader","ade@moi.com","ade",1);
// $admin->create_users("aaa", "aaa", "aaa","aaa@aaa.com","aaa",1);
// $id = $admin->get_ID("zMevJer");
// $admin->display_users();
// $admin->delete_users(2);
// echo "<a href=test.php?id=4>Suivre le lien</a>";

$result = $product->exist_product("lol");
if($result){
    echo "good";
}
else{
    echo "pas bon";
}
?>
