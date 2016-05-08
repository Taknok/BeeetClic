<?php

    session_start();

    print_r($_SESSION);
    include("php/fonctions.php");



    include("php/begin.php");
    include("php/home/carousel.php");
    echo "<hr>";
    include("php/home/recommendation.php");
    echo "<hr>";
    include("php/home/organisation.php");
    echo "<hr>";
    include("php/home/mention_legale.php");
    include("php/end.php");







?>