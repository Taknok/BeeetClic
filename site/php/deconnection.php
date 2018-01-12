<?php
include("fonctions.php");

mySessionStart();

session_destroy();
mySessionStart();
$_SESSION["flash"]["info"] = "Vous avez été dêêêconnecté !";

header("Location:../home.php");

?>
