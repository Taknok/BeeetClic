<?php

include("config.php");


function checkConnect(){
    if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]){
        return true;
    } else {
        return false;
    }
}


function connect2DB() {
  return mysqli_connect($GLOBALS['dbServ'], $GLOBALS['dbUser'], $GLOBALS['dbPass'], $GLOBALS['dbName']);
}


function auth($login, $motDePass) {
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT * FROM Compte WHERE pseudo=? AND motDePass=? ;");
    mysqli_stmt_bind_param($stmt, 'ss',$login, hash('sha512', $motDePass));
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
        
    if (mysqli_num_rows($request) != 0) { //if login success
        $assoc = mysqli_fetch_assoc($request);
        $_SESSION["connecte"] = true;
        $_SESSION["id"] = $assoc["id"];
        $_SESSION["pseudo"] = $assoc["pseudo"];
        $_SESSION["nom"] = $assoc["nom"];
        $_SESSION["prenom"] = $assoc["prenom"];
        $_SESSION["motDePass"] = $assoc["motDePass"];
        $_SESSION["argent"] = $assoc["argent"];
        return true;
        
    } else { //else
        $_SESSION["connecte"] = false;
        return false;

    }
    mysqli_free_result($request);
    mysqli_close($connexion);
}


function ajoutCompte($pseudo, $nom, $prenom, $email, $motDePass, $argent){
    //tester que les variables sont bien les tring ou int

    $argent = (int) $argent;
        
    
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "INSERT INTO Compte (pseudo, nom, prenom, email, motDePass, argent) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssssi',$pseudo, $nom, $prenom, $email, hash('sha512', $motDePass), $argent);
    $success = mysqli_stmt_execute($stmt);
    mysqli_close($connexion);
    
    return $success;
}

function supprCompte($id) {
  $connexion = connect2DB();
  $stmt = mysqli_prepare($connexion, "DELETE FROM Compte WHERE id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);
  mysqli_close($connexion);
}



function coteEq1($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT coteEq1 FROM Matchs WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    return $assoc['coteEq1'];

}















































?>