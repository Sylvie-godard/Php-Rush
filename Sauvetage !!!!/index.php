<?php

include_once("admin_product.php");
include_once("admin_categorie.php");

session_start();
if(!isset($_SESSION["username"]))
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
      <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<div class="container">

<?php echo "Hello " . $_SESSION["username"] . " how is it goin'?"?>

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



<footer>
<address>  PRODUCTION : Gang-Bang Théory <br> Copyright</address>
</footer>

</div>
    
</body>
</html>