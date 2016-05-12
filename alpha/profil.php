<?php

include_once("php/fonctions.php");

mySessionStart();
debug($_SESSION);

$id = $_SESSION["id"];

$nom = getNom($id);
$prenom = getPrenom($id);
$pseudo = $_SESSION["pseudo"];
$mail = getEmail($id);



include("php/begin.php");

?>




            
            <!-- PROFILE-->
            <section id="profile">
                <h2 class='text-center'> Profile :</h2>
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
            
            <!-- CHANGE INFO-->
            <section id="change-info">
                <h2 class='text-center'> Modifier mon profile :</h2>
                <form class="form-horizontal">
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
                    <input id="passwordinput" name="passwordinput" placeholder="" class="form-control input-md" required="" type="password">
                    <span class="help-block">8 characteres obligatoires</span>
                  </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"> </label>
                  <div class="col-md-4">
                    <button id="info_singlebutton" name="info_singlebutton" class="btn btn-info">Confirmer</button>
                  </div>
                </div>

                </fieldset>
             </form>
            </section>
            
            
            <hr>
            
            
            <!-- CHANGE PWD-->
            <section id="change-pwd">
                <h2 class='text-center'> Changer de mot de passe :</h2>
                <form class="form-horizontal">
             <fieldset>
                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Nouveaux mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="passwordinput" placeholder="" class="form-control input-md" required="" type="password">
                    <span class="help-block">8 characteres obligatoires</span>
                  </div>
                </div>
                 <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Confirmation</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="passwordinput" placeholder="" class="form-control input-md" required="" type="password">
                  </div>
                </div>
                 <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="passwordinput">Ancien mot de passe</label>
                  <div class="col-md-5">
                    <input id="passwordinput" name="passwordinput" placeholder="" class="form-control input-md" required="" type="password">
                  </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"></label>
                  <div class="col-md-4">
                    <button id="pwd_singlebutton" name="pwd_singlebutton" class="btn btn-info"> Confirmer</button>
                  </div>
                </div>

                </fieldset>
             </form>
            </section>
            
            
            <hr>
            
            
            <!-- RELOAD ACCOUNT-->
            <section id="reload_account" class="bootstrap-iso">
            <h2 class='text-center'> Crêêêditer compte :</h2>   
           <form class="form-horizontal">
            <fieldset>

            <!-- Prepended text-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="euros"></label>
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input id="euros" name="euros" class="form-control" placeholder="" required="" type="number">
                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="reload_account"></label>
              <div class="col-md-4">
                <button id="reload_account" name="reload_account" class="btn btn-info">Créditer</button>
              </div>
            </div>

            </fieldset>
            </form>

            </section>
            
            
                                        
<?php

include("php/end.php")                

?>