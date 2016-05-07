<?php



?>

<div id="header" class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
        <h1><a href="http://www.google.com"> Bêêêtclic </a></h1>
        <h3> Site de paris en ligne !</h3>
        </div>
        <!-- disapear if the widh is not enought  large --> 
        <div class="visible-lg-inline">
        <img src="http://www.qafco.qa/tennis/images/teng1.png" alt="Mouton con" >
        <img src="http://img.over-blog-kiwi.com/300x300/0/18/66/82/20150125/ob_c7cedf_logo.png" alt="Mouton con" width="150px" > 
        </div>
    </div>
</div>

<nav class="navbar navbar-inverse " data-spy="affix" data-offset-top="197">
  	<div class="navbar-header">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse" >
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
        <!--  HOME BUTTON  -->
		<a class="navbar-brand" href="#"><i class="glyphicon glyphicon-home"></i></a>
	</div>
	
    
	<div class="collapse navbar-collapse js-navbar-collapse">
		<!--   SPORT : SOCCER & TENNIS  -->
        <ul class="nav navbar-nav">
            

			<!-- SOCCER -->
			<li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> FOOTBALL <span class="caret"></span></a>				
				<ul style="display: none;" class="dropdown-menu mega-dropdown-menu">
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header"> Ligue 1</li>
							<li><a href="#"> Marseille</a></li>
							<li><a href="#">Paris</a></li>
							<li><a href="#">Nantes</a></li>
							<li><a href="#">Bordeaux</a></li>
							<li><a href="#"> ... </a></li>
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header"> Ligue étrangère </li>
							<li><a href="#">Navbar Inverse</a></li>
							<li><a href="#">Pull Right Elements</a></li>						
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header"> Résultat </li>
							<li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>                      
						</ul>
					</li>
				</ul>				
			</li>
			
            
			<!-- TENNIS -->
			<li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> TENNIS <span class="caret"></span></a>				
				<ul style="display: none;" class="dropdown-menu mega-dropdown-menu">
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Features</li>
							<li><a href="#">Auto Carousel</a></li>
							<li><a href="#">Carousel Control</a></li>
							<li><a href="#">Left &amp; Right Navigation</a></li>
							<li><a href="#">Four Columns Grid</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Fonts</li>
							<li><a href="#">Glyphicon</a></li>
							<li><a href="#">Google Fonts</a></li>
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Plus</li>
							<li><a href="#">Navbar Inverse</a></li>
							<li><a href="#">Pull Right Elements</a></li>
							<li><a href="#">Coloured Headers</a></li>                            
							<li><a href="#">Primary Buttons &amp; Default</a></li>							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Much more</li>
							<li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
				</ul>				
			</li>
		</ul>
        
        
        
		<!--Account  or Login & Register-->
		<ul class="nav navbar-nav navbar-right">
            
            
            <?php 
        
        if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]){ 
        
        ?>
            
            
            <!-- Account -->
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
				<ul class="dropdown-menu account-background">
					<li>
						<div class="navbar-content">
							<div class="row">
								<div class="col-md-5">
									<img src="http://placehold.it/120x120"
										alt="Alternate Text" class="img-responsive" />
									<p class="text-center small">
										<a href="#">Change Photo</a></p>
								</div>
								<div class="col-md-7">
									<span>Bhaumik Patel</span>
									<p class="text-muted small">
										mail@gmail.com</p>
									<div class="divider">
									</div>
									<a href="#" class="btn btn-primary btn-sm active">View Profile</a>
								</div>
							</div>
						</div>
						<div class="navbar-footer">
							<div class="navbar-footer-content">
								<div class="row">
									<div class="col-md-6">
										<a href="#" class="btn btn-default btn-sm">Change Passowrd</a>
									</div>
									<div class="col-md-6">
										<a href="php/deconnection.php" class="btn btn-default btn-sm pull-right">Sign Out</a>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								Login via
								<div class="social-buttons">
									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
								</div>
                                or
								 <form class="form" role="form" method="post" action="php/connection.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="text" class="form-control" id="exampleInputEmail2" name="login" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" class="form-control" id="exampleInputPassword2" name="pwd" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox"> keep me logged-in
											 </label>
										</div>
								 </form>
							</div>
							<div class="bottom text-center">
								New here ? <a href="php/inscription.php"><b>Join Us</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
            
            
            <!-- REGISTER BUTTON -->          
            <li>
                <a href="php/inscription.php" >Register</a>
            </li>
            
            <?php 
        
            }
        
            ?>
            
        </ul>
	</div>	
</nav>