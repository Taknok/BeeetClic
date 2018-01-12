<?php

mySessionStart();

$get = preventXSS($_GET);

?>


  <!--****************************************************************************************************************************
                                                  HEADER
 *******************************************************************************************************************************-->    
<div id="header" class="container-fluid">
    <style>
body{
    <?php
    if (isset($get["categorie"])){
        if ($get["categorie"] == "foot"){
            echo "background-image: url(image/green.jpg);";
        } else if ($get["categorie"] == "hand"){
            echo "background-image: url(image/parquet.jpg);";
        } else {
            
        }
    } else {
        echo "background:SeaShell;";
    }
    ?>
}
    </style>
    <div class="row">
        <div class="col-lg-8">
        <h1> 
            <a href="home.php">
                <img src="http://silhouettesfree.com/animals/farm-animals/sheep-front-silhouette-image.png" alt="Mouton" width="140px" > 
                <span class="visible-lg-inline visible-md-inline visible-sm-inline">Bêêêtclic</span> 
            </a>
        </h1>
        <h3> Mêêêilleur site de paris en ligne ! <small>on va vous tondre...</small></h3>
        </div>
        <!-- disapear if the widh is not enought  large --> 
        <div class="visible-lg-inline">
         
        
        <img src="image/hand_silhouette_header.png" alt="hand" width="200px" >
        <img src="image/soccer-silhouette_header.png" alt="foot"  > 
        </div>
    </div>
</div>