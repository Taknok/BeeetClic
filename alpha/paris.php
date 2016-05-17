<?php 

include_once("php/fonctions.php");

mySessionStart();


function displayMatch($pari){
    $_SESSION[$pari["id"]] = $pari;
    
    
    echo "<div >";
    echo "<a href='pari_details.php?id_match=" . $pari["id"] . "'>" . $pari["dateFin"] . " : " . $pari["nom"] . " : " . $pari["equipe1"] . " - " . $pari["equipe2"] . " cote : " . $pari["coteEq1"] . " cote : " . $pari["coteEq2"];
    echo "</div></a>";
<<<<<<< HEAD
}


$array = preventXSS($_POST);

$paris = getMatchs();




include("php/begin.php");

foreach($paris as $pari){
    displayMatch($pari);
}

=======
}


$array = preventXSS($_POST);

$paris = getMatchs();

debug($paris);


include("php/begin.php");

foreach($paris as $pari){
    displayMatch($pari);
}

debug($_SESSION);
>>>>>>> origin/master

?>




<?php
include("php/end.php");
?>