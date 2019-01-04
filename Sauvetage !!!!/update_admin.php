<?php
 include_once("admin_users.php");
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
$placeholder= new admin_users();
$valueholder= $placeholder->select_users($_GET["id"]);

$testuser =false;
if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
{
    extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
    $errors = array();

    $verify = new admin_users();

    if(strlen($firstname) < 3 || strlen($lastname) < 3 || strlen($username)< 3) 
    {
        array_push($errors, "Invalid firstname or lastname. Min 3 characters required.\n");
    }
    
   
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if(!preg_match($pattern , $email))
    {
        array_push($errors,"Invalid email\n");
    }

    if((strlen($password) < 3 || strlen($password) > 10) || ($password_confirmation != $password))
    {
        array_push($errors, "Invalid password or password confirmation\n");
    }

    if(empty($errors))
    {   
    
    $connexion= new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
    $connect=$connexion->getConn();

    $update = new admin_users;

        $testuser=$update->update_users($_GET['id']);
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
    <title>Update_user_admin</title>
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
<input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo $valueholder->firstname; ?>" required><br>
      <input type="text" name="lastname" id="lastname" placeholder="Lastname"value="<?php echo $valueholder->lastname; ?>" required><br>
      <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $valueholder->username; ?>"required><br>
      <input type="text" name="email" placeholder="example@gmail.com"value="<?php echo $valueholder->email; ?>" required><br>
      <input type="password" name="password" placeholder="Password" pattern=.{3,10} required ><br>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" pattern=.{3,10} required><br>       
      <button>Update </button>
</form>       

<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>

<br>
</body>
