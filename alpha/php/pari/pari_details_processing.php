<?php

$pb_detected = 0;


/*
check si l'id du match est valide
*/
if (isset($get["id_match"]) && !empty($get["id_match"])){
    $id_match = $get["id_match"];
    
} else {
    $_SESSION["flash"]["danger"] = "id de match non connu";
    $pb_detected = 1;
}

if (!avaiblePari($id_match)){
    $_SESSION["flash"]["danger"] = "id de match non connu";
    $pb_detected = 1;
} else {
    $pari = getMatch($id_match);
}

if( !$pb_detected){
    $deja_parie = aDejaParie($id_match, $_SESSION["id"] );
    
    if (!$deja_parie){
    
    
        /*
        check si ya eu une entré utilisateur sur un pari
        */
        if ( isset($post["montant-eq1"]) && !empty($post["montant-eq1"]) ){
            $montant = $post["montant-eq1"];
            $cote = $pari["coteEq1"];
            $choix = 1;
        } else if ( isset($post["montant-eq2"]) && !empty($post["montant-eq2"]) ){
            $montant = $post["montant-eq2"];
            $cote = $pari["coteEq2"];
            $choix = 2;
        } else if ( isset($post["montant-null"]) && !empty($post["montant-null"]) ){
            $montant = $post["montant-null"];
            $cote = $pari["coteNull"];
            $choix = 3;
        } else {
            $choix = 0;
        }

        if ($choix < 0 || $choix > 3 ){
            $_SESSION["flash"]["danger"] = "choix inconnu";
        }

        $pas_argent = 0;
        if ($choix != 0 && getArgent($_SESSION["id"]) < $montant){
            $_SESSION["flash"]["danger"] = "Vous n'avez pas assez d'argent sur votre compte :/";
            $pas_argent = 1;
        }

        if (!$pas_argent && $choix != 0 && !$deja_parie){ //si ya eu une entrée
            decArgent($_SESSION["id"], $montant);

            actualisePariMatch($pari, $choix);

            ajoutPari($id_match, $_SESSION["id"], $montant, $choix, $cote);

            $_SESSION["flash-refresh"]["success"] = "Votre pari a bien été pris en compte";
            header("Refresh:0");
        }
    
    } else {
        if (isset($get["submit-annulation"])){
            $id_pari = getIdPari($id_match, $_SESSION["id"]);
            annulationPari($id_pari);
            
            $_SESSION["flash-refresh"]["success"] = "Votre pari a été annulé";
            header("Refresh:0");
        }
    }
    

    
    
    
}

debug($pari);

?>