<?php


$id = $_SESSION["id"];

$nom = getNom($id);
$prenom = getPrenom($id);
$pseudo = $_SESSION["pseudo"];
$mail = getEmail($id);

$error = initErrorInputMessage();




/*
Modify prenom and nom
*/
if (isset($_POST["submit_name"])){
    $array=preventXSS($_POST);
    
    $error = errorOnText($error, $array, "nom");
    $error = errorOnText($error, $array, "prenom");
    
    if (checkPwd($pseudo,$array["pwd"])){
        $connexion = connect2DB();
    
        $stmt = mysqli_prepare($connexion, "UPDATE Compte SET prenom = ?, nom = ? WHERE pseudo = ?");
        mysqli_stmt_bind_param($stmt, 'sss', $array["nom"], $array["prenom"], $pseudo);
        $success =mysqli_stmt_execute($stmt);
        
        if (!$success){
            $_SESSION["flash"]["danger"] = "Nom et prénom non modifiés";
        } else {
            $_SESSION["flash-refresh"]["success"] = "Nom et prénom modifiés";
            header("Refresh:0");
        }
    } else {
        $_SESSION["flash"]["danger"] = "Nom et prénom non modifiés";
    }
}


/*
Modify email
*/
if (isset($_POST["submit_mail"])){
    $array=preventXSS($_POST);
    
    $error = errorOnMail($error, $array);
    
    if (!avaibleMail($array["mail"])){
        $error["mail"] = "ce mail est deja utilisé par un autre compte";
        $error["error-detected"] = 1;
    }
    
    if (checkPwd($pseudo,$array["pwd"]) && !$error["error-detected"]){
        $connexion = connect2DB();
    
        $stmt = mysqli_prepare($connexion, "UPDATE Compte SET mail = ? WHERE pseudo = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $array["mail"], $pseudo);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success){
            $_SESSION["flash"]["danger"] = "Mail non modifié";
        } else {
            $_SESSION["flash-refresh"]["success"] = "Mail modifié";
            header("Refresh:0");
        }
    } else {
        $_SESSION["flash"]["danger"] = "Mail non modifiés";
    }
}


/*
Modify pwd
*/
if (isset($_POST["submit_pwd"])){
    $array=preventXSS($_POST);
    
    $tmp_array["pwd"] = $array["new-pwd"];
    $tmp_array["confirm-pwd"] = $array["new-confirm-pwd"];
    
    $error = errorOnPwd($error, $tmp_array);
        
    
    debug($array);
    debug($error);
    
    if (checkPwd($pseudo,$array["pwd"]) && !$error["error-detected"]){
        $connexion = connect2DB();
    
        $stmt = mysqli_prepare($connexion, "UPDATE Compte SET motDePass = ? WHERE pseudo = ?");
        
        $hashed = hash('sha512', $array["new-pwd"]);
        
        mysqli_stmt_bind_param($stmt, 'ss', $hashed, $pseudo);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success){
            $_SESSION["flash"]["danger"] = "Mot de passe non modifié";
        } else {
            $_SESSION["flash-refresh"]["success"] = "Mot de passe modifié";
            header("Refresh:0");
        }
    } else {
        $_SESSION["flash"]["danger"] = "Mot de passe non modifié";
    }
}


/*
Add money
*/
if (isset($_POST["submit_argent"])){
    $array=preventXSS($_POST);
    
    
    if (isset($array["argent"]) && (!is_numeric($array["argent"]) || $array["argent"] < 0)){
        $error["argent"] = "Vous devez saisir une somme positive";
        $error["error-detected"] = 1;
    }
        
    
    debug($array);
    debug($error);
    
    if (checkPwd($pseudo,$array["pwd"]) && !$error["error-detected"]){
        $connexion = connect2DB();
    
        $stmt = mysqli_prepare($connexion, "UPDATE Compte SET argent = argent + ? WHERE pseudo = ?");        
        mysqli_stmt_bind_param($stmt, 'is', $array["argent"], $pseudo);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success){
            $_SESSION["flash"]["danger"] = "Compte non crédité";
        } else {
            $_SESSION["flash-refresh"]["success"] = "Compte crédité";
            header("Refresh:0");
        }
    } else {
        $_SESSION["flash"]["danger"] = "Compte non crédité";
    }
}


?>