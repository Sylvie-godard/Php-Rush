<?php

include_once("admin_product.php");
include_once("admin_categorie.php");


session_start();
if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}

$display = new Admin_product();
$products;
if(isset($_GET['q']) && !empty($_GET['q'])){
$products = $display->searchQ($_GET['q']);
}
else{
$products = $display->display_Allproducts();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GangBang - HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="materialize/css/materialize.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <a class="nav-link" href="index.php">Home  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="index_categories.php">Categories</a>  <!--Créer page catégorie -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index_profile.php">Profile</a> <!--Créer page profil -->
      </li> 
      <?php  if($_SESSION["admin"] || $_COOKIE["admin"]){?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin managements</a> <!--Créer page profil -->
      </li>
      <?php }?>
      <li class="nav-item">
        <a class="nav-link disabled" href="logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<div class="container">

<?php 
if(isset($_SESSION['username'])){
  echo "Hello " . $_SESSION["username"] . " how is it goin'?";
}
elseif(isset($_COOKIE['username'])){
  echo "Hello " . $_COOKIE["username"] . " how is it goin'?";
}

?>

<div class="row">
    <?php foreach($products as $product) : ?>
    <div class="card mb-4 ml-4 mr-4" style="width: 18rem;">
        <img class="card-img-top" src="bonbon.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $product["name"] ?> - <?php echo $product["price"] ."€" ?></h5>
            <p class="card-text"><?php echo $product["description"] ?></p>
            <a href="#" class="btn btn-primary">Buy product</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l4 offset-l2 s12">
                <address>  PRODUCTION : Gang-Bang Théory</address>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright
            </div>
          </div>
</footer>
</html>