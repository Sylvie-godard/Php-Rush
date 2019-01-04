<?php
include_once("admin_product.php");
include_once("DB_connect.php");
include_once("admin_categorie.php");
$testuser =false;

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
$category = new Admin_category();
$display_category= $category->display_AllCategories();

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();

    $verify = new admin_category();

    if($verify->exist_category($name))
    {
        array_push($errors, "This category already exist, please choose another name..\n");
    }
    if(empty($errors)){
        $testuser = $category->add_category($name,$parent);
        header('Location:admin.php?category=added');
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create cate</title>
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
      <a class="nav-link" href="index_categories.php">Categories</a>  <!--Créer page catégorie -->
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


    <form method="post">
    <?php if(!empty($errors)) { ?>
    <ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
    </ul>
    <?php } ?>

    <?php if($testuser) { ?>
    <h1>User Created</h1>
    <?php } ?>

      <input type="text" name="name" id="firstname" placeholder="Name of category" minlength="3" maxlength="20" required><br>
        
      <select id="categories" name="parent">
        <option value="0">choisir une catégorie</option>
          <?php 
          foreach($display_category as $category)
          echo "<option value=".$category["id"].">".$category["name"]."</option>";
          ?>
      </select>      
      <br>     
      <button>Add category</button> 
      <br>

<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>


</body>
</html>

