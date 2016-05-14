<?php

include("config.php");


function debug($var){
    echo "<pre>" .print_r($var, true) . "</pre>"; 
}

function mySessionStart(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
}


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
    
    $hashed = hash('sha512', $motDePass);
    
    mysqli_stmt_bind_param($stmt, 'ss',$login, $hashed );
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    
    mysqli_close($connexion);
    
    if (mysqli_num_rows($request) != 0) { //if login success
        $assoc = mysqli_fetch_assoc($request);
        $_SESSION["connecte"] = true;
        $_SESSION["id"] = $assoc["id"];
        $_SESSION["pseudo"] = $assoc["pseudo"];
        return true;
        
    } else { //else
        $_SESSION["connecte"] = false;
        return false;

    }
    
}

function checkPwd($pseudo, $pwd){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Compte WHERE pseudo=? AND motDePass=? ;");
    
    $hashed = hash('sha512', $pwd);
    
    mysqli_stmt_bind_param($stmt, 'ss',$pseudo, $hashed );
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    
    mysqli_close($connexion);
    if (mysqli_num_rows($request) != 0) { //if login success
        return true;
    } else { //else
        return false;

    }
    
}

function getArgent($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT argent FROM Compte WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['argent'];

}

function getNom($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT nom FROM Compte WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $test = mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['nom'];
}

function getPrenom($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT prenom FROM Compte WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['prenom'];
}

function getEmail($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT email FROM Compte WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['email'];
}

function getValid_mail($pseudo){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT validation_mail FROM Compte WHERE pseudo=? ;");
    mysqli_stmt_bind_param($stmt, 's',$pseudo);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['validation_mail'];
}

function setValid_mail($pseudo){
    $connexion = connect2DB();
    echo $pseudo;
    $stmt = mysqli_prepare($connexion, "UPDATE Compte SET validation_mail = NULL, validation_date = NOW() WHERE pseudo = ?");
    mysqli_stmt_bind_param($stmt, 's', $pseudo);
    $test = mysqli_stmt_execute($stmt);    
    mysqli_close($connexion);
    echo $test;
}

function ajoutCompte($pseudo, $nom, $prenom, $email, $motDePass, $argent, $valid_mail){
    //tester que les variables sont bien les tring ou int

    $argent = (int) $argent;
        
    
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "INSERT INTO Compte (pseudo, nom, prenom, email, motDePass, argent, validation_mail) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssssis',$pseudo, $nom, $prenom, $email, hash('sha512', $motDePass), $argent, $valid_mail);
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

function avaiblePseudo($pseudo){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Compte WHERE pseudo = ?");
    mysqli_stmt_bind_param($stmt, 's',$pseudo);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    
    if (empty($assoc)){
        return true;
    } else {
        return false;
    }
    
}

function avaibleMail($mail){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Compte WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's',$mail);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    
    if (empty($assoc)){
        return true;
    } else {
        return false;
    }
    
}

function coteEq1($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT coteEq1 FROM Matchs WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
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
    $error_input["error-detected"] = 0;
}


function errorOnText($error, $array, $cle){
    echo empty($array[$cle]);
    if ( empty($array[$cle])){ 
        $error[$cle] = $cle . " non complété";
        $error["error-detected"] = 1;
    } else if (!ctype_alnum($array[$cle])) { //if not only A-Z a-z 0-9
        $error[$cle] = $cle . " non valide";
        $error["error-detected"] = 1;
    }
    return $error;
}

function errorOnMail($error, $array){
    if (empty($array["mail"])){
        $error["mail"] = "mail nom complété";
        $error["error-detected"] = 1;
    }

    if (!filter_var($array["mail"], FILTER_VALIDATE_EMAIL) === true){
        $error["mail"] = "mail non valide";
        $error["error-detected"] = 1;
    }
    
    if ( empty($array["confirm-mail"])){
        $error["confirm-mail"] = "confirmation mail non complété";
        $error["error-detected"] = 1;
    } else if ($array["mail"] != $array["confirm-mail"]){
        $error["confirm-mail"] = "Le mail de confirmation ne correspond pas";
        $error["error-detected"] = 1;
    }
    return $error;
}
        
function errorOnPwd($error, $array){
    if ( empty($array["pwd"])){
        $error["pwd"] = "mot de passe non complété";
        $error["error-detected"] = 1;
    //mettre les condition sur le mot de passe ici
    }
    
    if (empty($array["confirm-pwd"])){
        $error["confirm-pwd"] = "confirmation de mot de passe non complété";
        $error["error-detected"] = 1;

    } else if ($array["pwd"] != $array["confirm-pwd"]){
        $error["confirm-pwd"] = "Le mot de passe de confirmation ne correspond pas";
        $error["error-detected"] = 1;
    }
    return $error;
}


function errorInput($array){
    $error_input = initErrorInputMessage();
    
    /*$fields = ["pseudo", "nom", "prenom", "mail", "confirm-mail", "pwd", "confirm-pwd", "age-checkboxes", "agreement-checkboxes", "argent"];
    
    
    //regarde si tous els champs ont été remplis
    foreach($fields as $element) {
        if(!isset($array[$element]) || empty($array[$element])) {
            $error_input["not-all-completed"] = 1;
            $error_input["error-detected"] = 1;
        }
    }*/
    
    
    
    $error_input = errorOnText($error_input, $array, "pseudo");
    
    if (!avaiblePseudo($array["pseudo"])){
        $error_input["pseudo"] = "pseudo deja pris";
        $error_input["error-detected"] = 1;
    }
    
    
    $error_input = errorOnText($error_input, $array, "nom");
    
    $error_input = errorOnText($error_input, $array, "prenom");
    
    
    $error_input = errorOnMail($error_input, $array);
    
    if (!avaibleMail($array["mail"])){
        $error_input["mail"] = "ce mail est deja utilisé par un autre compte";
        $error_input["error-detected"] = 1;
    }
       
    
    $error_input = errorOnPwd($error_input, $array);
                

    
    if ($array["age-checkboxes"] != 1){
        $error_input["age-checkboxes"] = "Vous devez etre majeur";
        $error_input["error-detected"] = 1;
    }
    
    if ($array["agreement-checkboxes"] != 1){
        $error_input["agreement-checkboxes"] = "Vous devez acceptez les CGU";
        $error_input["error-detected"] = 1;
    }
    
    if ($array["argent"] < 0){
        $error_input["argent"] = "Vous devez saisir une somme positive";
        $error_input["error-detected"] = 1;
    }
    
    return $error_input;
}






function displayErrorMessage($error){
    if (isset($error["error-detected"]) && $error["error-detected"]){
        $message = "<div class='alert alert-danger'> Erreur(s) : <ul>";
        foreach ($error as $cle => $element){
                switch ($cle){
                    case "pseudo":
                    case "nom":
                    case "prenom":
                    case "mail":
                    case "confirm-mail":
                    case "pwd":
                    case "confirm-pwd":
                    case "argent":
                    case "agreement-checkboxes":
                    case "age-checkboxes":
                        $message = $message . "<li>" . $element . "</li>";
                        break;
                    default:
                        break;
            }
        }
    $message = $message . "</ul></div>";
    echo $message;
    }
}


function generatedValidationEmail($len){
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double)microtime()*1000000);
    
    for($i=0; $i<$len; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    
    return $string;
}



//////////////////

function postsBets($sport) {
    
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT * FROM matchs WHERE sport = ? ORDER BY date_match DESC;");
    mysqli_stmt_bind_param($stmt, 's', $sport);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_free_result($res);
    mysqli_close($connexion);
    return $assoc;
}




function findBet($id) {
    
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT * FROM matchs WHERE id= ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc;
}























?>