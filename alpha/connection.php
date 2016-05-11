<?php
session_start();

print_r($_POST);

include("php/fonctions.php");
include("php/config.php");

if (isset($_POST['login']) && isset($_POST['pwd'])){
    if (auth($_POST['login'], $_POST['pwd'])){
        if (isset($_SESSION["from_home"])){
            header("Location:home.php");
        } else {
            header("Location:profil.php");
        }
    } else {
        $message = "erreur lors de la connaction";
    }
}

print_r($_SESSION);

$con = checkConnect();


?>

<?php
     if (isset($_SESSION["connecte"])){
         echo "<p>" .$message . "</p>";
     } else {
 ?>
<form name='signin' method='post' action='index.php'>
    <input type='text' name='login'><br />
    <input type='password' name='pwd'><br />
    <input type='submit' name='submit' value='Valider'>
</form>
<?php

     }

 ?>
