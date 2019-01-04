<?php
include_once("DB_connect.php");
include_once("admin_users.php");
include_once("admin_product.php");
include_once("admin_categorie.php");

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


$admin= new admin_users();
$sql_admin = "SELECT * FROM users";
$stmt= $admin->getBd()->prepare($sql_admin);
$stmt->execute();
$result_admin =$stmt->fetchAll(PDO::FETCH_OBJ);
//$admin->delete_users($_SESSION['username']);

$categories= new admin_category();
$display = $categories->display_AllCategories();
// $result_category =$stmt2->fetchAll(PDO::FETCH_OBJ);

$products= new Admin_product();
$displayproducts = $products->display_Allproducts();

?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>

 </head>
 <body>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">GangBang Theory, the Diabetes causers</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>  <!--Créer page catégorie -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index_profile.php">Profile</a> <!--Créer page profil -->
      </li>
      <?php  if($_SESSION["admin"]){?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin managements</a> <!--Créer page profil -->
      </li>
      <?php }?>
      <li class="nav-item">
        <a class="nav-link disabled" href="logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

 
    <!------------------------ PARTIE USERS ------------------------->
<?php if(isset($_GET["success"]) && $_GET["success"]=="true"){?>
<h3>
    User updated
</h3>
<?php } ?>
<?php if(isset($_GET["user"]) && $_GET["user"]=="created"){?>
<h3>
    New user created
</h3>
<?php } ?>
<h1> Users management: </h1>
<table>
  <tr>
    <th>ID</th>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Username</th>
    <th>Email</th>
    <th></th>
  </tr>
  <?php foreach ($result_admin as $result):?>
  <tr>
    <td> <?php echo $result->id ?></td>
    <td><?php echo $result->firstname?></td> 
     <td><?php echo $result->lastname?></td>     
     <td><?php echo $result->username?></td> 
    <td><?php echo $result->email?></td>
    <td> 
        <a href ="delete_user.php?id=<?php echo $result->id?>"> Delete </a>
        <a href ="update_admin.php?id=<?php echo $result->id?>"> Update </a>
        <a href ="display_users.php?id=<?php echo $result->id?>"> View User </a>

    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a href="createUser_admin.php">create user</a>
    
        


    <!------------------------ PARTIE Category ----------------------->
    <?php if(isset($_GET["category"]) && $_GET["category"]=="added"){?>
<h3>
    Category added
</h3>
<?php } ?>


<?php if(isset($_GET["category"]) && $_GET["category"]=="update"){?>
<h3>
    Category updated
</h3>
<?php } ?>
<h1> Categories management: </h1>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Parent_ID</th>
    <th></th>
  </tr>
  <?php foreach ($display as $categorie):?>
  <tr>
     <td><?php echo $categorie["id"] ?></td>
     <td><?php echo $categorie["name"] ?></td> 
     <td><?php echo $categorie["parent_id"]?></td>     
     <td> 
        <a href ="delete_category.php?id=<?php echo $categorie["id"]?>"> Delete </a>
        <a href ="update_category.php?id=<?php echo $categorie["id"]?>"> Update </a>
        <a href ="display_category.php?id=<?php echo $categorie["id"]?>"> View Category </a>
    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a href="create_category.php">create categorie</a>


    <!------------------------ PARTIE PRODUCTS ----------------------->
    <?php if(isset($_GET["product"]) && $_GET["product"]=="added"){?>
<h3>
    Product added
</h3>
<?php } ?>


<?php if(isset($_GET["products"]) && $_GET["products"]=="update"){?>
<h3>
    Product updated
</h3>
<?php } ?>
<h1> Products management: </h1>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category_ID</th>
    <th>Description</th>
    <th>Added_at</th>
  </tr>
  <?php foreach ($displayproducts as $product):?>
  <tr>
     <td><?php echo $product["id"] ?></td>
     <td><?php echo $product["name"] ?></td> 
     <td><?php echo $product["price"]?></td>    
     <td><?php echo $product["category_id"]?></td>   
     <td><?php echo $product["description"]?></td>     
     <td><?php echo $product["added_at"]?></td>     

    <td> 
        <a href ="delete_product.php?id=<?php echo $product["id"]?>"> Delete </a>
        <a href ="update_product.php?id=<?php echo $product["id"]?>"> Update </a>
        <a href ="display_product.php?id=<?php echo $product["id"]?>"> View Product </a>
    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a href="create_product.php">create product</a>

 </body>
 </html>