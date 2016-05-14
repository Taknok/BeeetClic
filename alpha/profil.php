<?php

include_once("php/fonctions.php");

mySessionStart();
debug($_SESSION);

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
            $_SESSION["flash"]["success"] = "Nom et prénom modifiés";
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
            $_SESSION["flash"]["success"] = "Mail modifié";
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
            $_SESSION["flash"]["success"] = "Mot de passe modifié";
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
            $_SESSION["flash"]["success"] = "Compte crédité";
        }
    } else {
        $_SESSION["flash"]["danger"] = "Compte non crédité";
    }
}
//"UPDATE TableName SET TableField = TableField + 1 WHERE SomeFilterField = @ParameterID"


include("php/begin.php");

?>



        <div style="padding:10px;">
            
            <!-- PROFILE-->
            <section id="profile">
                <h2 class='text-center'> Profil :</h2>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-2 col-md-2">
                        <img class="img-circle" width="120" src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg"
                        alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <blockquote>
                            <p><?= $nom . " " . $prenom; ?></p> <small> <?= $pseudo; ?></small>
                        </blockquote>
                        <p> <i class="glyphicon glyphicon-envelope"></i>
                            <?= $mail ?>
                        </p>
                    </div>
                </div>
            </section>
            
           
            <hr>
            
            <?php displayErrorMessage($error); ?>


            <!-- CHANGE INFO-->
            <section id="change-info">
                <h2 class='text-center'> Modifier mon profile :</h2>
                
                <form class="form-horizontal" method="post" action="profil.php">
                <fieldset>


                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nom"> Changer mon Nom</label>  
                  <div class="col-md-5">
                  <input id="nom" name="nom" placeholder="" class="form-control input-md" required="" type="text">

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="prenom">Changer mon Prénom</label>  
                  <div class="col-md-5">
                  <input id="prenom" name="prenom" placeholder="" class="form-control input-md" required="" type="text">

                  </div>
                </div>
                
                     <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="pwd" placeholder="" class="form-control input-md" required="" type="password">
                    <span class="help-block">8 characteres obligatoires</span>
                  </div>
                </div>
                    
                      <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"> </label>
                  <div class="col-md-4">
                    <button id="info_singlebutton" name="submit_name" class="btn btn-info">Confirmer</button>
                  </div>
                </div>

                </fieldset>
             </form>  
            </section>


            <hr>

            <!--MODIFY EMAIL-->
            <section id="change-mail">
                <h2 class='text-center'> Modifier email :</h2>
                <form class="form-horizontal" method="post" action="profil.php">
                <fieldset>

            

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="mail">Nouvelle E-mail</label>  
                  <div class="col-md-5">
                  <input id="mail" name="mail" placeholder="votre-email@quelquechose.quelquechose" class="form-control input-md" required="" type="email">
                  <span class="help-block">(un message vous sera envoyer pour confirmer votre compte)</span>  
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="confirm-mail">Confirmez votre  nouvelle E-mail</label>  
                  <div class="col-md-5">
                  <input id="confirm-mail" name="confirm-mail" placeholder="" class="form-control input-md" required="" type="email">

                  </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="pwd" placeholder="" class="form-control input-md" required="" type="password">
                    <span class="help-block">8 characteres obligatoires</span>
                  </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"> </label>
                  <div class="col-md-4">
                    <button id="info_singlebutton" name="submit_mail" class="btn btn-info">Confirmer</button>
                  </div>
                </div>

                </fieldset>
             </form>
            </section>
            
            
            <hr>
            
            <!-- CHANGE PWD-->
            <section id="change-pwd">
                <h2 class='text-center'> Changer de mot de passe :</h2>
                <form class="form-horizontal" method="post" action="profil.php">
             <fieldset>
                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Nouveaux mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="new-pwd" placeholder="" class="form-control input-md" required="" type="password">
                    <span class="help-block">8 characteres obligatoires</span>
                  </div>
                </div>
                 <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Confirmation</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="new-confirm-pwd" placeholder="" class="form-control input-md" required="" type="password">
                  </div>
                </div>
                 <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="pwd">Ancien mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="pwd" placeholder="" class="form-control input-md" required="" type="password">
                  </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"></label>
                  <div class="col-md-4">
                    <button id="pwd_singlebutton" name="submit_pwd" class="btn btn-info"> Confirmer</button>
                  </div>
                </div>

                </fieldset>
             </form>
            </section>
            
            
            <hr>
            
            
            <!-- RELOAD ACCOUNT-->
            <section id="reload_account" class="bootstrap-iso">
            <h2 class='text-center'> Crêêêditer compte :</h2>   
           <form class="form-horizontal" method="post" action="profil.php">
            <fieldset>

            <!-- Prepended text-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="euros"></label>
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input id="euros" name="argent" class="form-control" placeholder="" required="" type="text">
                </div>
              </div>
            </div>
            
            <!--Password-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="pwd">Mot de passe</label>
              <div class="col-md-5">
                <input id="passwordinput" name="pwd" placeholder="" class="form-control input-md" required="" type="password">
              </div>
            </div>
                
            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="reload_account"></label>
              <div class="col-md-4">
                <button id="reload_account" name="submit_argent" class="btn btn-info">Créditer</button>
              </div>
            </div>
                
            

            </fieldset>
            </form>

            </section>
            
        </div>
                                        
<?php

include("php/end.php")                

?>