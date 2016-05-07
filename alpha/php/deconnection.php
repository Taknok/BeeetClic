<?php
session_start();

/*if (isset($_POST["deco"])){*/
    session_destroy();
    header("Location:../home.php");
//}
?>

<!--
<form method="post" name="form_deco">
    <input type=submit name="deco" value="Deconnection">
</form>
-->
