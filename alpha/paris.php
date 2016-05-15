<?php 

function displayMatch($categorie,$pari){
    echo "div href=''>";
    echo "<form methode='post'>";
    echo "<a> "$dateFin . " " . $pari["nom"] . " : " . $pari["equipe1"] . " - " . $pari["equipe2"] . "<button name='submit-eq1' class=''>" . $pari["coteEq1"] . "</button>" . "<button name='submit-eq2' class=''>" . $pari["coteEq2"] . "</button></a>";
    echo "</form>";
    echo "</div>";
}

?>