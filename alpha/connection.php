<?php

include("php/fonctions.php");
include("php/config.php");

mySessionStart();



$array = preventXSS($_POST);

debug($array);

if (isset($array['login']) && isset($array['pwd'])){
    if (auth($array['login'], $array["pwd"])){
        
        $_SESSION["flash"]["success"] = "Connection reussi";
        header("Location:profil.php");

    } else {
        $_SESSION["flash"]["danger"] = "Pseudo ou mot de passe incorrect";
    }
}

print_r($_SESSION);

$con = checkConnect();

include("php/begin.php");

?>

<form name='signin' method='post' action='connection.php'>
    <input type='text' name='login'><br />
    <input type='password' name='pwd'><br />
    <input type='submit' name='submit' value='Valider'>
</form>
<a href="inscription.php">Inscription</a>


<?php
include("php/end.php");
?>