<?php



?>



<!--****************************************************************************************************************************
                                                  NAVBAR
 *******************************************************************************************************************************-->    
<nav class="navbar navbar-inverse " data-spy="affix" data-offset-top="197">
  	<div class="navbar-header">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse" >
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
        
        
        
        <!--  HOME BUTTON  -->
		<a class="navbar-brand" href="home.php"><i class="glyphicon glyphicon-home"></i></a>
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		
        <!--   SPORT : SOCCER & TENNIS  -->   
        <ul class="nav navbar-nav">
            <li><a href="paris.php?categorie=foot" > FOOTBÊÊÊLL</a></li>
            <li><a href="paris.php?categorie=hand" > HANDBÊÊÊLL </a></li>
        </ul>
        
        
        
        
        <!--Profile  or Login & Register-->
		<ul class="nav navbar-nav navbar-right">
            
            
            <?php 
        
        if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]){ 
        
        ?>
            
            
            <!-- PROFILE -->
			<li class="dropdown">
                <a href="profil.php" class="dropdown-toggle disabled" data-toggle="dropdown"> Profil <b class="caret"></b></a>
				<ul class="dropdown-menu account-background">
					<li>
						<div class="navbar-content">
							<div class="row">
								<div class="col-md-5">
									<img class="img-circle" width="120" src="http://i.skyrock.net/1825/7371825/pics/737539796_small.jpg"
            alt="" class="img-rounded img-responsive" />
									
								</div>
								<div class="col-md-7">
									<span>Bonjour <?= $_SESSION["pseudo"] ?></span>
									
									<a href="profil.php" class="btn btn-primary btn-sm active">Voir mon profil</a>
								</div>
							</div>
						</div>
						<div class="navbar-footer">
							<div class="navbar-footer-content">
								<div class="row">
									<div class="col-md-12">
										<a href="php/deconnection.php" class="btn btn-default btn-sm pull-right">Déconnexion</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</li>
            
            
            <?php 
        
            } else { 

            ?>
            
            <!--Login-->
            <li class="dropdown">
                <a href="connection.php" class="dropdown-toggle disabled" data-toggle="dropdown">Login<span class="caret" ></span></a>
                <ul id="login-dp" class="dropdown-menu">
                    <li>
                         <div class="row">
                                <div class="col-md-12">
                                    
                                     <form class="form" role="form" method="post" action="connection.php" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                 <label class="sr-only" for="exampleInputEmail2">Email</label>
                                                 <input type="text" class="form-control" id="exampleInputEmail2" name="login" placeholder="Email address" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                 <label class="sr-only" for="exampleInputPassword2">Mot de passe</label>
                                                 <input type="password" class="form-control" id="exampleInputPassword2" name="pwd" placeholder="Password" autocomplete="off" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                 <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                                            </div>
                                            
                                     </form>
                                </div>
                         </div>
                    </li>
                 </ul>
            </li>
            
            
            <!-- REGISTER BUTTON -->          
            <li>
                <a href="inscription.php" >S'enregistrer</a>
            </li>
            
            <?php 
        
            }
        
            ?>
            
        </ul>
	</div>	
</nav>