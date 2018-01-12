<?php

include("php/fonctions.php");

debug($_GET);

session_start();


$pseudo = $_GET["pseudo"];
$valid_mail = $_GET["valid_mail"];


$bdd_valid_mail = getValid_Mail($pseudo);

if ($valid_mail == $bdd_valid_mail){
    
    
    setValid_mail($pseudo);
    $_SESSION["flash"]["success"] = "Votre compte a bien été validé !";
    header("Location:connection.php");
} else {
    
    $_SESSION["flash"]["danger"] = "Ce lien n'est plus valide !";
    header("Location:inscription.php");
}


?>