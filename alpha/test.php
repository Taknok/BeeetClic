<?php

include("php/fonctions.php");


/*echo print_r($_SESSION);*/
echo "<br />";
echo "<br />";



$fields = ["pseudo", "nom", "prenom", "mail", "confirm-mail", "pwd", "confirm-pwd", "age-checkboxes", "agreement-checkboxes", "argent"];
    

//regarde si tous els champs ont été remplis
foreach($fields as $element) {
    $array[$element]= "";
}

$array["argent"] = -1;

$error = errorInput($array);
debug($error);


?>