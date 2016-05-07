<?php

//session_start();

include("fonctions.php");
include("config.php");



if(isset($_POST["supprCompte"])){
    supprCompte(17);
    session_destroy();
    header("index.php");
}

?>


<form name="from_supprCompte" action="supprCompte.php" method="post">
    <input type="submit" name="supprCompte" value="Supprimer mon compte">
</form>
