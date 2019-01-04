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
$placeholder= new admin_category();
$valueholder= $placeholder->select_category($_GET['id']);
$display_category= $placeholder->display_AllCategories();
$parent_name = $placeholder->select_category($valueholder["parent_id"]);

$testuser =false;
if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
{
    extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
    
        $errors = array();

        $verify = new admin_category;
    
        if(strlen($name) < 3) 
        {
            array_push($errors, "Invalid name. Min 3 characters required.\n");
        }
        
    if($old_name != $name){
        if($verify->exist_category($name))
        {
            array_push($errors, "This category already exist, please choose another name..\n");
        }
    }
        
    
        if(empty($errors))
            {
        $update = new admin_category;
    
            $placeholder->edit_category($_GET['id']);
            header("location:admin.php?success=true");
            // header("location:login.php");     RAJOUTER AVEC DELAY DE 3 SEC
           }
}

?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update_cat_admin</title>
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

<?php if(!empty($errors)) { ?>
<ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
</ul>
<?php } ?>

<?php if($testuser) { ?>
<h1>User Updated</h1>
<?php ;} ?> 
<form methode ="post">
<input type="hidden" name="old_name" value="<?php echo $valueholder["name"]; ?>">
<input type="text" name="name" id="name" placeholder="name" value="<?php echo $valueholder["name"]; ?>" required><br>
      <select id="categories" name="parent_id">
          <?php
            echo" <option value='0'>choisir une catégorie</option>";
            // echo "<option value=".$valueholder["parent_id"].">".$parent_name['name']."</option>";
            foreach($display_category as $category){
                $selected = "";
                if($category["id"] == $valueholder["parent_id"])
                {
                    $selected = "selected";
                }
                  echo "<option value=".$category["id"]." $selected >".$category["name"]."</option>";
            }
          ?>
      </select> 
      <br>     
      <button>Update Category</button>
</form>  
<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>     
<br>
</body>
