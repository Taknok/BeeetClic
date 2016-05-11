<?php


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
                            <p>Bruce Wayne</p> <small> Batman</small>
                        </blockquote>
                        <p> <i class="glyphicon glyphicon-envelope"></i> masterwayne@batman.com
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
                  <input id="mail" name="mail" placeholder="votre-email@quelquechose.quelquechose" class="form-control input-md" required="" type="text">
                  <span class="help-block">(un message vous sera envoyer pour confirmer votre compte)</span>  
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="confirm-mail">Confirmez votre  nouvelle E-mail</label>  
                  <div class="col-md-5">
                  <input id="confirm-mail" name="confirm-mail" placeholder="" class="form-control input-md" required="" type="text">

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
            <h2 class='text-center'> Changer de mot de passe :</h2>   
           <form class="form-horizontal">
            <fieldset>

            <!-- Prepended text-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="euros"></label>
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input id="euros" name="euros" class="form-control" placeholder="" required="" type="text">
                </div>
                <p class="help-block">max 100€</p>
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
            
            
            
        </div>
<!--****************************************************************************************************************************
                                                 SIDEBAR
 *******************************************************************************************************************************--> 
        <div class="col-lg-4">
            <div class="slidebar">  

                             
<!--******************************************************************
                           Social
********************************************************************--> 


                <ul class="social-network social-circle">
                    
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="icoEnvelope" title="envelope"><i class="fa fa-envelope"></i></a></li>
                </ul>				



<!--******************************************************************
                           HISTORIQUE
********************************************************************--> 
                <section id=old-bets>
                    <h2 > Historique des paris :</h2>
                    Vous n'avez jamais parié sur notre site !
                </section>
            
            </div>
        </div>
     </div>
</div>
<!--****************************************************************************************************************************
                                                CONTAINER END
 *******************************************************************************************************************************-->   
    
    
    
    
    
    
    
    
<!--****************************************************************************************************************************
                                                FOOTER
 *******************************************************************************************************************************-->       


    <footer>
    <div class="footer" id="footer">
        <div class="container">       
            <div class="home-doctors  clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6  text-center doc-item">
                            <div class="common-doctor animated fadeInUp clearfix ae-animation-fadeInUp">
                                <ul class="list-inline social-lists animate">
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                </ul>
                                <figure>
                                        <img width="670" height="500" src="Image/sheep1.jpg" alt="sheep-1" class="doc-img animate attachment-gallery-post-single wp-post-image"> 
                                </figure>
                                <div class="text-content">
                                    <h5>Grijol Guillaume</h5>
                                    <h5><small> Co-fondateur </small></h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6   col-lg-offset-1 col-md-offset-1  text-center doc-item">
                            <div class="common-doctor animated fadeInUp clearfix ae-animation-fadeInUp">
                                <ul class="list-inline social-lists animate">
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                </ul>
                                <figure>
                                        <img width="670" height="500" src="Image/sheep2.jpg" class="doc-img animate attachment-gallery-post-single wp-post-image" alt="sheep-2"> 
                                </figure>
                                <div class="text-content">
                                    <h5>Gressier Paul</h5>
                                    <h5><small> Co-fondateur </small></h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-3 col-sm-6   col-lg-offset-1 col-md-offset-1">
                            <h3> PARTENAIRES </h3>
                            <ul>
                                <li> <a href="http://www.enseirb-matmeca.fr/"> Enseirb </a> </li>
                                <li> <a href="http://www.moncreditrapide.info/"> Besoin d'un crédit ?</a> </li>
                                <li> <a href="http://www.gohumour.com/animaux/moutons"> Ici on a le sens de l'humour </a> </li>
                            </ul>
                            
                            <h3> Faite vous aidez ! </h3>
                            <ul>
                                <li> <a href="http://infos-jeux-argent.com/?q=content/la-d%C3%A9pendance-au-jeu"> Dépendant ? </a> </li>
                            </ul>
                            
                            <h3> Social </h3>
                            <ul class="social">
                                <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                                <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                                <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                            </ul>   
                        </div>
                        
        
                        <div class="visible-sm clearfix margin-gap"></div>
                    </div>
                </div>
            </div>

            <img  src="Image/jouer_comporte_des_risques.png" alt="jouer_comporte_des_risques"> 
            <h4 class="text-center">
            Toute personne souhaitant faire l'objet d'une interdiction de jeux doit le faire elle-même auprès du ministère de l'intérieur. Cette interdiction est valable dans les casinos, les cercles de jeux et sur les sites de jeux en ligne autorisés en vertu de la loi n° 2010-476 du 12 mai 2010. Elle est prononcée pour une durée de trois ans non réductible.</h4>
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Bêêêtclic  2016. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                	<li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul> 
            </div>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>
</body>
</html>
