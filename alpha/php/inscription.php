<?php

session_start();

include("fonctions.php");
include("config.php");

print_r($_SESSION);

if (isset($_POST["Sub_Inscription"])){
    $inscription_success = ajoutCompte($_POST["Ins_pseudo"], $_POST["Ins_name"], $_POST["Ins_firstName"], $_POST["Ins_email"], $_POST["Ins_motDePass"], $_POST["Ins_argent"]);
    
    print_r($_SESSION);
    //header("Refresh:0");
}

?>


<?php

if(isset($inscription_success) && $inscription_success){

?>

<p>Inscription reussi !</p>
<a href="../home.php"><b>Retour à l'Acceuil</b></a>

<?php

} else {

?>
<p>Inscription</p>
<form method="post" name="inscription" action="inscription.php">
    <input type="text" name="Ins_pseudo" ><br />
    <input type="text" name="Ins_name" ><br />
    <input type="text" name="Ins_firstName" ><br />
    <input type="text" name="Ins_email" ><br />
    <input type="password" name="Ins_motDePass" ><br />
    <input type="text" name="Ins_argent" ><br />
    <input type="submit" name="Sub_Inscription" value="Inscription">
</form>


<?php
    if (isset($inscription_success) && !$inscription_success){
        echo "<p> Erreur</p>";
    }
    
}

?>
