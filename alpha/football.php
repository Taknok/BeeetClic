<?php

    session_start();

    print_r($_SESSION);
    include("php/fonctions.php");

    
    $posts = postsbets("football");


    if (isset($_POST["bet"])){
        $info_bet = findBet($_POST["id_bet"]);
        print_r($info_bet);
        $team1 = $info_bet['equipe1'];
         $team2 =$info_bet['equipe2'];
         $date = $info_bet['date_match'];
         $cote_team1 = $info_bet['coteEq1'];
         $cote_team2 = $info_bet['coteEq2'];
         $cote_null = $info_bet['nul'];
       
    }


    include("php/begin.php");
?>
<?php if (isset($_POST["bet"])): ?>
        <section class="bet  row" style="padding :40px;">
            <date class=" col-md-12"> <span class="label label-info"><?= $date ?></span></date>
            <div class="col-md-6">
                <h2><?= $team1 ?>  VS  <?= $team2 ?></h2>
            </div>
          
            <form class="form-horizontal col-md-6">
                <fieldset>


                <div class="form-group">
                  <label class="col-md-4 control-label" for="team1"><?= $team1 ?></label>
                  <div class="col-md-4">
                    <button id="team1" name="team1" class="btn btn-success"><?= $cote_team1 ?> pariez !</button>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-4 control-label" for="nul"> nul </label>
                  <div class="col-md-4">
                    <button id="nul" name="nul" class="btn btn-success"><?= $cote_null ?> pariez !</button>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-4 control-label" for="team2"><?= $team2 ?></label>
                  <div class="col-md-4">
                    <button id="team2" name="team2" class="btn btn-success"><?= $cote_team2 ?> pariez !</button>
                  </div>
                </div>
                    
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">€</span>
                      <input id="prependedtext" name="prependedtext" class="form-control" placeholder="" required="" type="text">
                    </div>
                </div>


                </fieldset>
            </form>

         </section>
    <hr>
<?php endif ?>




 <div class="row" style='margin:0;'>
     
     <div> Liste des paris de footbal !</div>
<?php foreach ($posts as $post):
     $team1 = $post['equipe1'];
     $team2 = $post['equipe2'];
     $date = $post['date_match'];
     $cote_team1 = $post['coteEq1'];
     $cote_team2 = $post['coteEq2'];
     $cote_null = $post['nul'];
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
        <form class="form-horizontal" method="post" action="football.php">
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

</div> 
       

             

        
           


<?php
    include("php/end.php");
?>