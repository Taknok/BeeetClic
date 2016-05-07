<?php

session_start();
?>


<html>
<body>
    <?php
    
    if (isset($_SESSION["connecte"])){
        if ($_SESSION["connecte"]){
            include("supprCompte.php");
            include("deconnection.php");
        }
    } else {
        include("inscription.php");
        include("connection.php");
    }

    ?>
</body>
</html>

