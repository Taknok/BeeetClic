<?php

include_once("php/fonctions.php");

mySessionStart();


$get = preventXSS($_GET);
$post = preventXSS($_POST);

if (isset($_SESSION["id"])){ //si on es connecté
    include("php/pari/pari_details_processing.php");
    
} else {
    $_SESSION["flash"]["danger"] = "Veuillez vous connecter pour parier";
    $pb_detected = 1;
}




include("php/begin.php");

if (!$pb_detected){
    if ($deja_parie){
        $id_pari = getIdPari($id_match, $_SESSION["id"]);
        if (pariFini($id_pari)){ //si le pari est fini
            if (getGagne($id_pari)){

                ?>
<p>Fecilication vous avez gagné</p>


<?php
            } else {
?>

<p>dommage vous avez perdu</p>

<?php
            }
?>
            
<p></p>



<?php
        
        } else {
           $infoMatch= getMatch($get["id_match"]);
?>


<h3>Vous avez pariez sur : <span class="label label-default"><?= $infoMatch["equipe1"]?> - <?= $infoMatch["equipe2"]?> </span></h3>
<form method="get" action="pari_details.php">
    <input type="hidden" name="id_match" value="<?= $id_match; ?>">
    <button class=" btn btn-danger" name="submit-annulation"> Annulez mon pari</button>
    <small>-  seulement 50% de la somme pariée vous sera rendue  -</small>
</form>
<hr>
<h3>Finir le match :</h3>

<form method="get" action="php/terminer_match.php">
    <input type="hidden" name="id_match" value="<?= $id_match; ?>">
    <button class=" btn btn-success" name="submit-annulation"> Finir ce match</button>
</form>

<?php
           }
    } else {
        if (matchFini($id_match)){
?>


<p>Ce match est fini, vous ne pouvez plus parier</p>


<?php
         } else {
?>









<h1><?= $pari["equipe1"] ?> - <?= $pari["equipe2"] ?></h1>
<date class="label label-info"> fin le <?= $pari["dateFin"]; ?> </date>
<p> Nombre de personnes ayant pariées : <?= $pari["nbparieurs"]; ?></p>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>" oninput="x.value=parseInt((a.value*<?= $pari["coteEq1"]?>*100))/100 ">
    <?= $pari["equipe1"] ?> 
    <input id="a" type="number" step="0.01" name="montant-eq1"> cote : <?= $pari["coteEq1"] ?>
    <button id="singlebutton" name="submit-Eq1" class="btn btn-info"> 
        Valider 
    </button>
    Gain potentiel : <output style="display: inline-block;color:red" name="x" for="a"> </output> €
</form>
<br>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>" oninput="x.value=a.value*<?= $pari["coteNull"] ?>">
    Null  
    <input id="a" type="number" min="0" step="0.01" name="montant-null">cote : <?= $pari["coteNull"] ?>
    <button id="singlebutton" name="submit-null" class="btn btn-info"> 
        Valider 
    </button>
    Gain potentiel : <output style="display: inline-block;color:red" name="x" for="a"> </output> €
</form>
<br>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>" oninput="x.value=a.value*<?= $pari["coteEq2"] ?>">
    <?= $pari["equipe2"] ?> 
    <input id="a" type="number" step="0,01" name="montant-eq2">cote : <?= $pari["coteEq2"] ?>
    <button id="singlebutton" name="submit-Eq2" class="btn btn-info"> 
        Valider 
    </button>
    Gain potentiel : <output  style="display: inline-block;color:red" name="x" for="a"> </output> €
</form>


<?php
            }
        }
    } else {
?>

<p> Erreur </p>
    
<?php
}

include("php/end.php");

?>