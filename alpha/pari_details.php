<?php

include_once("php/fonctions.php");

mySessionStart();

echo "session";
debug($_SESSION);
echo "post";
debug($_POST);
echo "get";
debug($_GET);

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

?>


<p>Vous avez pariez sur :</p>
<form method="get" action="pari_details.php">
    <input type="hidden" name="id_match" value="<?= $id_match; ?>">
    <button name="submit-annulation"> Annulez mon pari</button>
    <p>seulement 50% de la somme pariée vous sera rendue</p>
</form>

<p>Finir le match :</p>

<form method="get" action="php/terminer_match.php">
    <input type="hidden" name="id_match" value="<?= $id_match; ?>">
    <button name="submit-annulation"> Finir ce match</button>
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









<h1> <?= $pari["nom"] ; ?></h1>

<p><?= $pari["equipe1"] ?> - <?= $pari["equipe2"] ?></p>
<p> fin le <?= $pari["dateFin"]; ?> </p>
<p> Nombre de personnes ayant pariées : <?= $pari["nbparieurs"]; ?></p>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>">
    <?= $pari["equipe1"] ?> 
    <input type="number" step="0.01" name="montant-eq1"> cote : <?= $pari["coteEq1"] ?>
    <button id="singlebutton" name="submit-Eq1" class="btn btn-info"> 
        Valider 
    </button>
</form>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>">
    Null  
    <input type="number" min="0" step="0.01" name="montant-null">cote : <?= $pari["coteNull"] ?>
    <button id="singlebutton" name="submit-null" class="btn btn-info"> 
        Valider 
    </button>
</form>
<form method="post" action="pari_details.php?id_match=<?= $id_match; ?>">
    <?= $pari["equipe2"] ?> 
    <input type="number" step="0,01" name="montant-eq2">cote : <?= $pari["coteEq2"] ?>
    <button id="singlebutton" name="submit-Eq2" class="btn btn-info"> 
        Valider 
    </button>
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