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

function preventXSS($array){
    foreach ($array as $cle => $element){
        $array[$cle] = htmlspecialchars(strip_tags($element));
    }
    return $array;
}

function initErrorInputMessage(){
    $error_input["not-all-completed"] = 0;
    $error_input["pseudo"] = 0;
    $error_input["nom"] = 0;
    $error_input["prenom"] = 0;
    $error_input["mail"] = 0;
    $error_input["pwd"] = 0;
    $error_input["age-checkboxes"] = 0;
    $error_input["agreement-checkboxes"] = 0;
    $error_input["argent"] = 0;
    $error_input["error-detected"] = 0;
}

function errorInput($array){
    $error_input = initErrorInputMessage();
    
    $fields = ["pseudo", "nom", "prenom", "mail", "confirm-mail", "pwd", "confirm-pwd", "age-checkboxes", "agreement-checkboxes", "argent"];
    
    foreach($fields as $element) {
        if(!isset($_POST[$element]) || empty($_POST[$element])) {
            $error_input["not-all-completed"] = 1;
            $error_input["error-detected"] = 1;
        }
    }
    
    
    
    foreach ($array as $cle => $element){
        switch($cle){
            case "pseudo":
            case "nom":
            case "prenom":
                if (!ctype_alnum($element)){ //if not only A-Z a-z 0-9
                    $error_input[$cle] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            case "mail":
                //check if mail exist here
                if ($array["mail"] != $array["confirm-mail"]){
                    $error_input["mail"] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            case "pwd":
                // check qu'il fait au moins x case avec mak min etc
                if ($array["pwd"] != $array["confirm-pwd"]){
                    $error_input["pwd"] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            case "age-checkboxes":
                if ($element != 1){
                    $error_input[$cle] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            case "agreement-checkboxes":
                if ($element != 1){
                    $error_input[$cle] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            case "argent":
                if ($element < 0){
                    $error_input["argent"] = 1;
                    $error_input["error-detected"] = 1;
                }
                break;
            default:
                break;
        }
    }
    return $error_input;
}












































?>