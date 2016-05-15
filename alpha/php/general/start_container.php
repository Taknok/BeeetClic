<?php

if(isset($_SESSION["flash"])){
    
    foreach ($_SESSION["flash"] as $cle => $message){

?>

    <div class="alert alert-<?= $cle; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=
          $message;
        ?>
    </div>

<?php
        
    }
    unset($_SESSION["flash"]);
}

if(isset($_SESSION["flash-refresh"])){
    foreach ($_SESSION["flash-refresh"] as $cle => $message){
        $_SESSION["flash"][$cle] = $message;
    }
    unset($_SESSION["flash-refresh"]);
}


?> 

 <div id="main_part" class="container">   
     <div class="row">