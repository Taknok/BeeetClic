<?php

include_once("php/fonctions.php");


/*echo print_r($_SESSION);*/
echo "<br />";
echo "<br />";



$paris = getMatchs();

$pari = getMatch(4);
debug($pari);


annulationPari(7);

?>