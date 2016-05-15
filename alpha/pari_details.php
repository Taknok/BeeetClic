<?php

include_once("php/fonctions.php");

mySessionStart();






$array = preventXSS($_POST);

$pari = $array["pari"];

$pb_detected = 0;

if (isset($array["id"]) && !empty($array["id"])){
    $id = $array["id"];
} else {
    $_SESSION["flash"]["danger"] = "id de match non connu";
    $pb_detected = 1;
}

if (!avaiblePari($id)){
    $_SESSION["flash"]["danger"] = "id de match non connu";
    $pb_detected = 1;
}


include("php/begin.php");

if (!$pb_detected){

?>

<h1> <?= $pari["nom"] ; ?></h1>

<p><?= $pari["equipe1"] ?> - <?= $pari["equipe2"] ?></p>
<form>
    <input type="number" name="montant-eq1">
    <button type="submit" name="submit-Eq1"><?= $pari["coteEq1"] ?></button>
    <input type="number" name="montant-eq2">
    <button type="submit" name="submit-Eq2"><?= $pari["coteEq2"] ?></button>
</form>



<?php
} else {
?>

<p> Erreur </p>
    
<?php
    
}
include("php/end.php");

?>