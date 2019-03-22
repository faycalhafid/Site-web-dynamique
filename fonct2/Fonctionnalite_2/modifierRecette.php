<html>
    <?php
        include ('functions/connect_bdd.php');
        $ID=$_GET['id'];
        $sql="SELECT * FROM recettes WHERE ID=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        $r=$result[0];
        echo "<a href=\"contenuRecette.php?id=".$ID."\">Mode lecture</a><br/>\n";
        echo "<a href='update.php?id=".$ID."&obj=recette'>Supprimer la recette</a><br/>\n";
        echo "Titre de la recette : ".$r['titre']."<a href=\"modifier.php?id=".$ID."&obj=titre\">Modifier</a><br/>\n
              Auteur de la recette : ".$r['auteur']."<br/>\n
              Publiée le :".$r['datecreation']."<br/>\n";
        $utilisateur=$r['auteur'];

        echo "<br/><br/><h>Ingredients :</h>     \n 
             <a href=\"modifier.php?id=".$ID."&obj=ingredients&action=modifier\">Modifier</a>\n
             <a href=\"modifier.php?id=".$ID."&obj=ingredients&action=ajouter\"><img src=\"add-button.png\" width='15' height='15'></a>\n
             <a href=\"modifier.php?id=".$ID."&obj=ingredients&action=supprimer\"><img src=\"delete-button.png\" width='15' height='15   '></a>\n
             <br/>\n";

        $sql="SELECT * FROM `listeingredients` WHERE ID_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        foreach ($result as $r){
            echo "<li>".$r['qte'].$r['unit']."  " .$r['ingredient']." <br/>\n";
        }
        echo " <br/>";

        $sql="SELECT * FROM listeetapes WHERE ID_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        foreach($result as $r){
            echo "<br/><li><h> Etape ".$r['num_etape']."     <a href=\"modifier.php?id=".$ID."&obj=etape&num=".$r['num_etape']."\">Modifier</a>  <br/>".$r['etape']."\n";
        }
        echo "<br/><br/><a href=\"viewRecettes.php\">"." Retour</a>\n";
        include ('functions/disconnect_bdd.php');
    ?>
    <h> Notez cette recette !</h><br/>
    <form method="post" action="<?php echo 'noterRecette.php?id='.$ID.'&utilisateur='.$utilisateur ?>">
        <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
            <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
        </fieldset>
        <input type="submit" name="submit" value="Noter la recette"/>
    </form>
    <link rel="stylesheet" type="text/css" href="stars.css">

</html>



