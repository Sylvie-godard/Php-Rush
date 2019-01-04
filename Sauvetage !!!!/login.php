<?php

include_once("DB_connect.php");
include_once("admin_users.php");


$dsn = "mysql:host=127.0.0.1;dbname=pool_php_rush;port=3306";
$conn = new PDO($dsn, "root", "root"); 
 

if(!empty($_POST))
{
    extract($_POST);

    $login = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $sql = "SELECT password, email, username ,admin
            FROM users
            WHERE email = :login";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if($result)
    {
        if(password_verify($password, $result->password))  
        {
            session_start();
            $_SESSION["email"] = $login;
            $_SESSION["username"] = $result->username;
            $_SESSION["admin"]= $result->admin;
            $get = new admin_users();
            $id = $get->get_ID($_SESSION["username"]);
            $_SESSION["id"]= $id;

            header("Location:index.php?id=$id");
            exit; 
        }
    }       
    else
    {
        ?> <h2>Incorrect email/password</h2> <?php
    }
} 

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php if(isset($_GET["success"]) && $_GET["success"]=="true"){?>
<h1>
    User created
</h1>
<?php } ?>
    <form method="post">

    Email: <input type="text" name="email" placeholder="exemple@gmail.com"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Log in">
    <p> Don't have an account? Sign up <a href="inscription.php">HERE </a>
    <p> <a href="forgotpassword.php"> Forgot your password? </a>

    </form>

</body>
</html>
