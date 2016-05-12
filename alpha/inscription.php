<?php

session_start();

include("php/fonctions.php");
include("php/config.php");

function displayError($error, $cle){
    if (isset($error[$cle]) && $error[$cle]){
        echo "class='form-control form-error input-md' value='" . $_POST[$cle] . "'";
    } else if (isset($error["error-detected"])){
        echo "class='form-control input-md' value='" . $_POST[$cle] . "'"; 
    } else {
        echo "class='form-control input-md'"; 
    }
}

debug($_SESSION);


$error = initErrorInputMessage();
$array =[];





debug($_POST);
echo "<br/>";


if (isset($_POST["submit-inscription"])){
    
    $array = preventXSS($_POST);
    
    $error = errorInput($array);
    debug($error);
    
    //check ici si ya deja un des entrées existante
    
    if (!$error["error-detected"]){
        $valid_mail = generatedValidationEmail(255);
        
        $send_mail_succes = mail($array["mail"], "Validation de votre compte BeeetClic", "Cliquez sur le lien pour valider votre compte :\n" . $GLOBALS["addrServ"] . "valid_compte.php?pseudo=" . $array["pseudo"] . "&valid_mail=" . $valid_mail . "\nVeuillez ignorer cette email si vous ne vous etes pas inscrit sur BeeetClic" );
        
        debug($send_mail_succes);
        
        if (!$send_mail_succes){
            $error["error-detected"] = 1;
            $error["mail"]  ="Erreur lors de l'envoie du mail de confirmation à l'adresse indiquée";
        } else {
            $inscription_success = ajoutCompte($array["pseudo"], $array["nom"], $array["prenom"], $array["mail"], $array["pwd"], $array["argent"], $valid_mail);
            
            $_SESSION["flash"]["success"] = "Un mail de validtion vous a été envoyé";
            
            header("Location:home.php");
        }
        
    }
    
}

?>


<?php

    include("php/begin.php");

?>


<style>
    .form-error{
        border-color: red;
    }
    .form-error:focus{
        border-color:red;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(102, 10, 10, 0.6);
    }

</style>



 <form class="form-horizontal" method="post" name="inscription", action="inscription.php">
    <fieldset>

    <!-- Form Name -->
    <legend class="text-center"> Inscrivez vous et jouez ! </legend>

    <?php
    displayErrorMessage($error);
    ?>
        
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="pseudo"><span style=".form-control:focus">  Pseudo</span></label>  
        <div class="col-md-5">
        <input id="pseudo" name="pseudo" placeholder="" 
               
               <?php
                displayError($error, "pseudo");
               ?>
               
            required type="text">
        <span class="help-block">(espace et charatères speciaux non autorisés) </span>  
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="nom">Nom</label>  
        <div class="col-md-5">
        <input id="nom" name="nom" placeholder="" 
               
               <?php
                displayError($error, "nom");
               ?>
               
               required="" type="text">

        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="prenom">Prénom</label>  
        <div class="col-md-5">
        <input id="prenom" name="prenom" placeholder="" 
               
               <?php
                displayError($error, "prenom");
               ?>
               
               required="" type="text">

    </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="mail">E-mail</label>
        <div class="col-md-5">
        <input id="mail" name="mail" placeholder="votre-email@quelquechose.quelquechose" 
               
               <?php
                displayError($error, "mail");
               ?>
               
               required="" type="email">
        <span class="help-block">(un message vous sera envoyer pour confirmer votre compte)</span>  
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm-mail">Confirmez votre E-mail</label>  
        <div class="col-md-5">
        <input id="confirm-mail" name="confirm-mail" placeholder="" 
               
               <?php
                displayError($error, "confirm-mail");
               ?>
               
               required="" type="email">

    </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="passwordinput">Mot de passe</label>
        <div class="col-md-5">
        <input id="passwordinput" name="pwd" placeholder="" 
               
               <?php
                displayError($error, "pwd");
               ?>
               
            required type="password">
        <span class="help-block">8 characteres obligatoires</span>
    </div>
    </div>

    <!-- Password comfirm input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm-passwordinput">Confirmez votre mot de passe</label>
        <div class="col-md-5">
        <input id="confirm-passwordinput" name="confirm-pwd" placeholder="" 
               
               <?php
                displayError($error, "confirm-pwd");
               ?>
               
               required="" type="password">

        </div>
    </div>
        
    <!-- Money money-->
<!--<label class="col-md-4 control-label" for="euros"></label>
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input id="euros" name="euros" class="form-control" placeholder="" required="" type="number">
                </div>
                <p class="help-block">max 100€</p>
              </div>
      </div>-->
        
        
        
    <div class="form-group">
        <label class="col-md-4 control-label" for="euros">Argent</label>
        <div class="col-md-5">
            <div class="input-group">
            <span class="input-group-addon">€</span>
            <input id="money" name="argent" placeholder="" 

                   <?php
                    displayError($error, "argent");
                   ?>

                   required="" type="number">

            </div>
        </div>
    </div>

    <!-- Majeur Checkboxes (inline) -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="age-checkboxes">Je comfime être majeur</label>
        <div class="col-md-4">
        <label class="checkbox-inline" for="age-checkboxes-0">
          <input name="age-checkboxes" id="age-checkboxes-0" value="1"  type="checkbox">
          Oui
        </label>
        <label class="checkbox-inline" for="age-checkboxes-1">
          <input name="age-checkboxes" id="age-checkboxes-1" value="0" active type="checkbox">
          Non
        </label>
    </div>
    </div>

    <!-- CGU Checkboxes (inline) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="agreement-checkboxes">J'accepte les conditions d'utilisations</label>
      <div class="col-md-4">
        <label class="checkbox-inline" for="agreement-checkboxes-0">
          <input name="agreement-checkboxes" id="agreement-checkboxes-0" value="1" type="checkbox">
          Oui
        </label>
        <label class="checkbox-inline" for="agreement-checkboxes-1">
          <input name="agreement-checkboxes" id="agreement-checkboxes-1" active value="0" type="checkbox">
          Non
        </label>
    </div>
    </div>

    <!-- Button -->
    <div class="form-group">
    -     <label class="col-md-4 control-label" for="singlebutton"></label>
    <div class="col-md-4">
          <button id="singlebutton" name="submit-inscription" class="btn btn-info"> 
              INSCRIPTION 
          </button>
    </div>
    </div>

    </fieldset>
</form>


<?php

    include("php/end.php");

?>