<?php 

include_once("php/fonctions.php");

mySessionStart();

//$array = preventXSS($_POST);

$get = preventXSS($_GET);

$paris = getMatchs($get["categorie"]);


include("php/begin.php");

?>


<?php foreach ($paris as $post):
     $team1 = $post['equipe1'];
     $team2 = $post['equipe2'];
     $date = $post['dateFin'];
     $cote_team1 = $post['coteEq1'];
     $cote_team2 = $post['coteEq2'];
     $cote_null = $post['coteNull'];
     $id = $post['id'];
     ?>
     
     
     <section class="col-md-6" style="border: solid black 1px;">
        <date class="label label-info"><?= $date ?></date>
        <h3> <?= $team1 ?>  - <?= $team2 ?> </h3>
        <div class="row">
            <div class=" col-md-12">
                <h3>
                    <span class="label label-info"><?= $cote_team1 ?></span><?= $team1 ?>
                </h3>
            </div>


            <div class="col-md-12">
                <h3>
                    <span class="label label-info"><?= $cote_null ?></span> Nul
                </h3>
            </div>


            <div class="col-md-12">
                <h3>
                    <span class="label label-info"><?= $cote_team2 ?></span><?= $team2 ?>
                </h3>
            </div>
        </div>
        <form class="form-horizontal" method="post" action="pari_details.php?id_match=<?= $id ?>">
            <fieldset>

            <!-- Button -->
                <input type="hidden" value="<?= $id ?>" name="id_bet"> 
                <div class="form-group">
                    <button id="bet" name="bet" class="btn btn-success center-block"> Pariez !</button>
                </div>

            </fieldset>
         </form> 
     </section>
     
     
     <!-- 
        -->

<?php endforeach ; ?>




<?php
include("php/end.php");
?>