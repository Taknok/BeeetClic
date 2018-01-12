<?php


mySessionStart();
if (isset($_SESSION["id"])){
    $mes_paris = getParis($_SESSION["id"]);
}
?>

<section id=old-bets>
    
<?php if (isset($_SESSION["id"])){ ?>
    <br><br>
    <h2> <span class="label label-default">Argent : <?= getArgent($_SESSION["id"]); ?> € </span></h2>
    <h3 > Vos paris :</h3>
    <?php
    if ($mes_paris == []){
        
    ?>
    Vous n'avez jamais parié sur notre site !
<?php
    } else {
        foreach ($mes_paris as $pari){
        $match =getMatch($pari["idMatch"]);
            
            
    
?>

    <h4><?= $match["equipe1"] ;?> - <?= $match["equipe2"] ;?></h4>
    <h4>Mise : <?= $pari["montant"] ;?> €</h4>
    <a href="pari_details.php?id_match=<?=$pari["idMatch"] ;?>" class="btn btn-info"> Voir le pari</a>
    <hr>
    
    
<?php
        }
    }
 }
?>
</section>