<?php
include_once("admin_product.php");
include_once("DB_connect.php");
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

$prod1 = new Admin_product();
$valueProd = $prod1->get_ID_product($_GET["id"]);


$options = new admin_category();
$categories = $options->display_AllCategories();

if(!empty($_POST))
{
    extract($_POST);

    $products = new Admin_product();
    $editProd = $products->edit_product($_GET["id"]);   
    header('Location:admin.php?products=update');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index</title>
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
        <a class="nav-link" href="index_profile">Profile</a> <!--Créer page profil -->
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


    <form method="post">

      <input type="text" name="name" id="name" placeholder="Name of product" minlength="3" maxlength="20" value="<?php echo $valueProd->name; ?>" required><br>
      <input type="number" step="0.01" name="price" id="price" placeholder="Price" min=0 value="<?php echo $valueProd->price; ?>" required><br>
      <textarea cols="50" rows="4" name="description" id="description" placeholder="Description of your product" required ><?php echo $valueProd->description; ?></textarea><br>

      <select id="categories" name="category_id">
          <?php 
          foreach($categories as $category){
            $selected = "";
            if($category["id"] == $valueProd->category_id){
                $selected = "selected";
            }
            echo "<option value=".$category["id"]." $selected >".$category["name"]."</option>";
         }
          ?>
      </select>
          
      <br>     

      <button>Update product</button> 
      <br>

      <p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>

</body>
</html>