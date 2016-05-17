<?php

include_once("fonctions.php");

mySessionStart();

$get = preventXSS($_GET);

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

if(isset($get["submit-annulation"])){
    
    //$gagnant = rand(1,3); //généraion d'un vaincueur au hasard
    $gagnant = 1;
    
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "UPDATE Matchs SET fini = 1, gagnant = ? WHERE id = ? ");
    mysqli_stmt_bind_param($stmt, 'ii', $gagnant, $id_match);
    mysqli_stmt_execute($stmt);
    
    $stmt = mysqli_prepare($connexion, "SELECT * FROM Paris WHERE idMatch = ?");
    mysqli_stmt_bind_param($stmt, 'i',$id_match);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    while ($assoc){
        $result[$assoc["idParieur"]] = $assoc;
        $assoc = mysqli_fetch_assoc($request);
    }
    
    debug($result);
    
    foreach($result as $pari){
        
        if ($pari["equipe"] == $gagnant && !pariFini($pari["idPari"])){
            $montant = $pari["montant"] * $pari["cote"];
            
            //credite le compte
            $stmt = mysqli_prepare($connexion, "UPDATE Compte  SET argent = argent + ? where id = ? ");
            mysqli_stmt_bind_param($stmt, 'di', $montant, $pari["idParieur"]);
            mysqli_stmt_execute($stmt);
            
            //met le paris gagné et actualise la date d'edition du pari
            $stmt = mysqli_prepare($connexion, "UPDATE Paris SET gagne = 1, datePari = NOW() where idPari = ? ");
            mysqli_stmt_bind_param($stmt, 'i', $pari["idPari"]);
            mysqli_stmt_execute($stmt);
            
        }
        $stmt = mysqli_prepare($connexion, "UPDATE Paris SET fini = 1, datePari = NOW() where idPari = ? ");
        mysqli_stmt_bind_param($stmt, 'i', $pari["idPari"]);
        mysqli_stmt_execute($stmt);
            
    }
    //supprime tous les paris de plus de 10 min fini
    $stmt = mysqli_prepare($connexion, "DELETE FROM Paris WHERE datePari < ( NOW() - INTERVAL 10 MINUTE ) ");
    mysqli_stmt_execute($stmt);
    
    mysqli_close($connexion);
    
}

header("Location:../paris.php");

?>