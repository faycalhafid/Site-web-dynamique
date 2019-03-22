<html>
    <?php
        include ('functions/connect_bdd.php');
        $ID=$_GET['id'];
        $obj=$_GET['obj'];
        $sql="SELECT * FROM recettes WHERE ID=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        $r=$result[0];
        echo "<a href=\"contenuRecette.php?id=".$ID."\">Mode lecture</a>
         <a href=\"modifierRecette.php?id=".$ID."\">Annuler</a><br/>\n";
        if ($obj=="titre"){
            echo "\nTitre de la recette : <form method=\"post\" action=\"update.php?id=".$ID."&obj=".$obj.">\n
            <input type=\"text\" name=\"titre\" value=\"".$r['titre']."\"/>\n
            <input type=\"submit\" name=\"Appliquer\" value=\"Appliquer\"/>\n
            </form>\n";
        }

        else {
            echo "\nTitre de la recette : ".$r['titre']."<br/>\n";
        }

        echo "\nAuteur de la recette : ".$r['auteur']."<br/>\nPubliée le :".$r['datecreation']."<br/>\n";
        $utilisateur=$r['auteur'];

    ?>
    <br/>
    <br/>
    <h>Ingredients :</h>
    <br/>
    <?php
        $sql="SELECT * FROM `listeingredients` WHERE ID_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        if (isset($_GET['action'])){
            $action=$_GET['action'];
        }
        //<input type="text" name="'.$r['ingredient'].'" value="'.$r['ingredient'].'"/>
        if ($obj=="ingredients")
        {
            if ($action=="modifier"){
                echo "<form method=\"post\" action=\"update.php?id=".$ID."&obj=".$obj."&action=modifier\">\n";
                foreach($result as $r){
                    echo "<input type=\"number\" name=\"qte_".$r['ingredient']."\" value=\"".$r['qte']."\"/>\n
                      <input type=\"text\" name=\"unit".$r['ingredient']."\" value=\"".$r['unit']."\"/>\n   "
                        .$r['ingredient']."<br/>\n";
                }
                echo "<input type=\"submit\" name=\"submit\" value=\"Appliquer\"/></form>\n";
            }
            if ($action=="ajouter"){
                foreach ($result as $r){
                    echo "<li>".$r['qte'].$r['unit']."  ".$r['ingredient']." <br/>\n";
                }
                echo "<form method=\"post\" action=\"update.php?id='.$ID.'&obj='.$obj.'&action=ajouter\">\n
                <input type=\"number\" name=\"qte\" value=\"0\" />\n
                <input type=\"text\" name=\"unit\" value=\"\" />\n
                <input type=\"text\" name=\"ingredient\" value=\"ingredient\"/>\n
                <input type=\"submit\" name=\"submit\" value=\"Ajouter\"/>\n";
            }
            if ($action=="supprimer"){
                foreach ($result as $r){
                    echo "<a href=\"update.php?id=".$ID."&obj=".$obj."&action=supprimer&ing=".$r['ingredient']."\">
                          <img src=\"delete-button.png\" width='15' height='15'></a>\n";
                    echo $r['qte'].$r['unit']." ".$r['ingredient']."<br/>\n";
                }
            }


        }
        else
        {
            foreach ($result as $r){
                echo "<li>".$r['qte'].$r['unit']."  ".$r['ingredient']." <br/>\n";
            }
        }

        echo " <br/>\n";

        $sql="SELECT * FROM listeetapes WHERE ID_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        if ($obj=="etape")
        {
            if (isset($_GET['num'])){
                $num=$_GET['num'];

            }
            foreach($result as $r){
                if ($num==$r['num_etape'])
                    {   echo "<br/><li><h> Etape ".$r['num_etape']."<br/>\n";
                        echo "<form method=\"post\" action=\"update.php?id=".$ID."&obj=".  $obj."&num=".$num."\">\n
                              <input type=\"text\" name=\"etape\" value=\"".$r['etape']."\" />\n
                              <input type=\"submit\" name=\"submit\" value=\"Appliquer\"/>\n
        </form>\n";
                    }
                else {
                    echo "<br/><li><h> Etape ".$r['num_etape']."<br/>".$r['etape']."\n";
                }

        }
        }
        else {
            foreach($result as $r){
                echo "<br/><li><h> Etape ".$r['num_etape']."<br/>".$r['etape']."\n";
        }
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



