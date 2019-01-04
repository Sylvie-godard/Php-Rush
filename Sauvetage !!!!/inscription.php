<?php
 include_once("DB_connect.php");
 include_once("admin_users.php");
 $testuser =false;
if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
{
    extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
    $errors = array();

    $verify = new admin_users();

    if(strlen($firstname) < 3 || strlen($lastname) < 3 ) 
    {
        array_push($errors, "Invalid firstname or lastname. Min 3 characters required.\n");
    }
    if($verify->exist_username($username))
    {
        array_push($errors, "Username is already taken..\n");
    }
    if($verify->exist_email($email))
    {
        array_push($errors, "Email is already taken..\n");
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

    $create = new admin_users;

        $testuser=$create->create_users($firstname,$lastname,$username,$email,$password);
        header("location:login.php?success=true");
       }
    
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<form action="inscription.php" method="post">

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
<input type="text" name="firstname" id="firstname" placeholder="Firstname" required><br>
      <input type="text" name="lastname" id="lastname" placeholder="Lastname" required><br>
      <input type="text" name="username" id="username" placeholder="Username" required><br>
      <input type="text" name="email" placeholder="example@gmail.com" required><br>
      <input type="password" name="password" placeholder="Password" pattern=.{3,10} required ><br>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" pattern=.{3,10} required><br>       
          <button>Sign Up</button> 
      <p>Already have an account ? Login <a href="login.php">HERE </a>
         

</form>
</body>
</html>

            