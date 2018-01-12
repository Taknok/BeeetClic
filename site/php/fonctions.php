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
    $connexion =  mysqli_connect($GLOBALS['dbServ'], $GLOBALS['dbUser'], $GLOBALS['dbPass'], $GLOBALS['dbName']);
    if (mysqli_connect_errno($connexion)){
        echo "<p class=> Echec lors de la connection a la base de donnée" . mysqli_connect_error() . "</p>";
    }
    return $connexion;

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

function getMatchs($categorie){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT * FROM Matchs WHERE categorie = ?;");
    mysqli_stmt_bind_param($stmt, 's', $categorie);    
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $result=[];
    $assoc = mysqli_fetch_assoc($request);
    while ($assoc){
        $result[$assoc["id"]] = $assoc;
        $assoc = mysqli_fetch_assoc($request);
    }

    
    
    mysqli_close($connexion);
    return $result;
}

function getMatch($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT * FROM Matchs WHERE id = ?;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);

    $assoc = mysqli_fetch_assoc($request);

    return $assoc;
}

function setValid_mail($pseudo){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "UPDATE Compte SET validation_mail = NULL, validation_date = NOW() WHERE pseudo = ?;");
    mysqli_stmt_bind_param($stmt, 's', $pseudo);
    mysqli_stmt_execute($stmt);    
    mysqli_close($connexion);
}

function ajoutCompte($pseudo, $nom, $prenom, $email, $motDePass, $argent, $valid_mail){
    
    $hashed = ash('sha512', $motDePass);
    
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "INSERT INTO Compte (pseudo, nom, prenom, email, motDePass, argent, validation_mail) VALUES (?, ?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, 'sssssds',$pseudo, $nom, $prenom, $email, $hased, $argent, $valid_mail);
    $success = mysqli_stmt_execute($stmt);
    mysqli_close($connexion);
    
    return $success;
}

function supprCompte($id) {
  $connexion = connect2DB();
  $stmt = mysqli_prepare($connexion, "DELETE FROM Compte WHERE id = ?;");
  mysqli_stmt_bind_param($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);
  mysqli_close($connexion);
}

function avaiblePseudo($pseudo){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Compte WHERE pseudo = ?;");
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
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Compte WHERE email = ?;");
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

function avaiblePari($id){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT id FROM Matchs WHERE id = ?;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    
    mysqli_close($connexion);
    if (mysqli_num_rows($request) == 0) { //if id not found
        return false;
    } else { //else
        return true;

    }
    
}
/*
function coteEq1($id){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT coteEq1 FROM Matchs WHERE id=? ;");
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['coteEq1'];

}*/


function aDejaParie($id_match, $id_joueur){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT idPari FROM Paris WHERE idMatch = ? AND idParieur = ? ;");
    mysqli_stmt_bind_param($stmt, 'ii', $id_match, $id_joueur);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    
    mysqli_close($connexion);
    if (mysqli_num_rows($request) == 0) { //if id not found
        return false;
    } else { //else
        return true;
    }
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
    if ( !isset($array["mail"]) || empty($array["mail"]) ){
        $error["mail"] = "mail nom complété";
        $error["error-detected"] = 1;
        return $error; //return here to exit function and not test other  in case mail not set
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
    if ( !isset($array["pwd"]) || empty($array["pwd"]) ){
        $error["pwd"] = "mot de passe non complété";
        $error["error-detected"] = 1;
    //mettre les condition sur le mot de passe ici
    }
    if (strlen($array["pwd"]) <6){
        $error["pwd"] = "mot de passe inférieur à 6 charactères";
        $error["error-detected"] = 1;
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
    
    $fields = ["pseudo", "nom", "prenom", "mail", "confirm-mail", "pwd", "confirm-pwd", "age-checkboxes", "agreement-checkboxes", "argent"];
    
    
    //regarde si tous els champs ont été remplis
    foreach($fields as $element) {
        if(!isset($array[$element])) {
            $error_input["error-detected"] = 1;
            $error_input[$element] = $element . " non defini";
            return $error_input;
        }
    }
    
    
    
    $error_input = errorOnText($error_input, $array, "pseudo");
    
    if (isset($array["mail"]) && !avaiblePseudo($array["pseudo"])){
        $error_input["pseudo"] = "pseudo deja pris";
        $error_input["error-detected"] = 1;
    }
    
    
    $error_input = errorOnText($error_input, $array, "nom");
    
    $error_input = errorOnText($error_input, $array, "prenom");
    
    
    $error_input = errorOnMail($error_input, $array);
    
    if (isset($array["mail"]) && !avaibleMail($array["mail"])){
        $error_input["mail"] = "ce mail est deja utilisé par un autre compte";
        $error_input["error-detected"] = 1;
    }
       
    
    $error_input = errorOnPwd($error_input, $array);
                

    
    if (isset($array["age-checkboxes"]) && $array["age-checkboxes"] != 1){
        $error_input["age-checkboxes"] = "Vous devez etre majeur";
        $error_input["error-detected"] = 1;
    }
    
    if (isset($array["age-checkboxes"]) && $array["agreement-checkboxes"] != 1){
        $error_input["agreement-checkboxes"] = "Vous devez acceptez les CGU";
        $error_input["error-detected"] = 1;
    }
    
    if (isset($array["argent"]) && (!is_numeric($array["argent"]) || $array["argent"] < 0)){
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


function displayError($error, $cle){
    if (isset($error[$cle]) && $error[$cle]){
        echo "class='form-control form-error input-md' value='" . $_POST[$cle] . "'";
    } else if (isset($error["error-detected"])){
        echo "class='form-control input-md' value='" . $_POST[$cle] . "'"; 
    } else {
        echo "class='form-control input-md'"; 
    }
}
















function actualisePariMatch($pari, $choix){
    $nb_choix = 3; //eq1 eq2 ou null
    $n = 3; //facteur d'evolution
    
    $id = $pari["id"];
    
    $nb_parieurs_Eq1 = $pari["nbParieurEq1"];
    $nb_parieurs_Eq2 = $pari["nbParieurEq2"];
    $nb_parieurs_Null = $pari["nbParieurNull"];
    
    if ($choix == 1){
         $nb_parieurs_Eq1 = $nb_parieurs_Eq1 + 1; //plus le nouveau
    } else if ($choix == 2){
        $nb_parieurs_Eq2 = $nb_parieurs_Eq2 + 1;
    } else if ($choix == 3){
        $nb_parieurs_Null = $nb_parieurs_Null + 1;
    } else {
        die("error choix");
    }
    
    $nvCoteEq1 = 1 + ( $pari["coteEq1ini"] / ( $nb_choix * ( $nb_parieurs_Eq1 / ($pari["nbparieurs"] + 1 ) ) )  );
    $nvCoteEq2 = 1 + ( $pari["coteEq2ini"] / ( $nb_choix * ( $nb_parieurs_Eq2 / ($pari["nbparieurs"] + 1 ) ) )  );
    $nvCoteNull = 1 + ( $pari["coteNullini"] / ( $nb_choix * ( $nb_parieurs_Null / ($pari["nbparieurs"] + 1 ) ) )  );
    
    $connexion = connect2DB();
    
    
    $stmt = mysqli_prepare($connexion, "UPDATE Matchs SET coteEq1 = ?, nbParieurEq1 = ? , nbparieurs = nbparieurs + 1  WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'dii', $nvCoteEq1, $nb_parieurs_Eq1, $id);
    mysqli_stmt_execute($stmt);
    
    $stmt = mysqli_prepare($connexion, "UPDATE Matchs SET coteEq2 = ?, nbParieurEq2 = ? , nbparieurs = nbparieurs + 1  WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'dii', $nvCoteEq2, $nb_parieurs_Eq2, $id);
    mysqli_stmt_execute($stmt);
    
    $stmt = mysqli_prepare($connexion, "UPDATE Matchs SET coteNull = ?, nbParieurNull = ? , nbparieurs = nbparieurs + 1  WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'dii', $nvCoteNull, $nb_parieurs_Null, $id);
    $success = mysqli_stmt_execute($stmt);

    mysqli_close($connexion);
}



function ajoutPari($id_match, $id_joueur, $montant, $equipe, $cote){

    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "INSERT INTO Paris (idMatch, idParieur, montant, equipe, cote, datePari, gagne, fini) VALUES (?, ?, ?, ?, ?, NOW(), 0, 0);");
    mysqli_stmt_bind_param($stmt, 'iidid', $id_match, $id_joueur, $montant, $equipe, $cote);
    $success = mysqli_stmt_execute($stmt);
    mysqli_close($connexion);
    
    return $success;
}


function decArgent($id_joueur, $montant){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "UPDATE Compte SET argent = argent - ? WHERE id = ?;");
    mysqli_stmt_bind_param($stmt, 'di', $montant, $id_joueur);
    mysqli_stmt_execute($stmt);    
    mysqli_close($connexion);
}


function annulationPari($id_pari){
    $connexion = connect2DB();
    $stmt = mysqli_prepare($connexion, "SELECT idParieur, montant FROM Paris WHERE idPari = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id_pari);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $pari = mysqli_fetch_assoc($request);
    
    $argent = $pari["montant"] * 0.5; //on rends que 50% de la somme pariée
    echo"argent";
    
    $stmt = mysqli_prepare($connexion, "UPDATE Compte  SET argent = argent + ? where id = ? ;");
    mysqli_stmt_bind_param($stmt, 'di', $argent, $pari["idParieur"]);
    mysqli_stmt_execute($stmt);
    
    $stmt = mysqli_prepare($connexion, "DELETE FROM Paris WHERE idPari = ?;");
    mysqli_stmt_bind_param($stmt, 'i', $id_pari);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($connexion);
    
}

function getIdPari($id_match, $id_joueur){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT idPari FROM Paris WHERE idMatch = ? AND idParieur = ?;");
    mysqli_stmt_bind_param($stmt, 'ii', $id_match, $id_joueur);
    mysqli_stmt_execute($stmt);
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    return $assoc['idPari'];
}

function pariFini($id_pari){
    $connexion = connect2DB();

    $stmt = mysqli_prepare($connexion, "SELECT fini FROM Paris WHERE idPari = ?;");
    mysqli_stmt_bind_param($stmt, 'i',$id_pari);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    
    if (empty($assoc)){
        $_SESSION["flash"]["danger"] = "pari inconnu";
    } else {
        if( $assoc["fini"] == 1){
            return true;
        } else {
            return false;
        }
    }
}

function matchFini($id_match){
    $connexion = connect2DB();

    $stmt = mysqli_prepare($connexion, "SELECT fini FROM Matchs WHERE id = ?;");
    mysqli_stmt_bind_param($stmt, 'i',$id_match);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    
    if (empty($assoc)){
        $_SESSION["flash"]["danger"] = "match inconnu";
    } else {
        if( $assoc["fini"] == 1){
            return true;
        } else {
            return false;
        }
    }
}

function getGagne($id_pari){
    $connexion = connect2DB();

    $stmt = mysqli_prepare($connexion, "SELECT idPari FROM Paris WHERE (idPari = ? AND fini = 1 AND gagne = 1 );");
    mysqli_stmt_bind_param($stmt, 'i',$id_pari);
    mysqli_stmt_execute($stmt);
    
    $request = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($request);
    
    mysqli_close($connexion);
    
    if (mysqli_num_rows($request) != 0){
        return true;
    } else {
        return false;
    }
}

function getParis($id_joueur){
    $connexion = connect2DB();
    
    $stmt = mysqli_prepare($connexion, "SELECT * FROM Paris WHERE idParieur = ? ORDER BY datePari DESC ;");
    mysqli_stmt_bind_param($stmt, 'i',$_SESSION["id"]);
    
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_free_result($res);
    mysqli_close($connexion);
    return $assoc;
}