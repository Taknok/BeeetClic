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

    include("")

?>



<?php

if(isset($inscription_success) && $inscription_success){

?>



<?php

} else {

?>









<?php
    if (isset($inscription_success) && !$inscription_success){
        echo "<p> Erreur</p>";
    }
    
}

?>
