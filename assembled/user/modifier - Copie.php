<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
<aside style="width: 40%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>
</aside>
<section style="margin-left:200px;
    color:#23272b;
">
    <?php
        include ('functions/connect_bdd.php');
        $ID=$_GET['id'];
        $obj=$_GET['obj'];
        $sql="SELECT * FROM recettes WHERE id_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        $r=$result[0];
        $id_user=$_SESSION['id_user'];
        $sql="SELECT nom, prenom FROM users WHERE id_user=?";
        $arr=array($r['id_user']);
        include('functions/select_from_bdd.php');
        $nom=$result[0]['nom'];
        $prenom=$result[0]['prenom'];
        if ($r['id_user']!=$id_user){
            header("Location:membre.php");
        }
        echo "<a href=\"contenuRecette.php?id=".$ID."\">Mode lecture</a>
         <a href=\"modifierRecette.php?id=".$ID."\">Annuler</a><br/>\n";
        if ($obj=="titre"){
            echo "\n
            <table style='color:#23272b;
                font-size: small;'>
            <form method=\"post\" action=\"update.php?id=".$ID."&obj=".$obj."\">\n
            <tr><th>Titre de la recette : </th><td><input type=\"text\" name=\"titre\" value=\"".$r['titre']."\" style='width: 150px;'/></td>\n
            <td><input type=\"submit\" name=\"Appliquer\" value=\"Appliquer\"/></td>\n
            </form>\n
            <tr><th>Auteur de la recette :</th><td>".$nom." ".$prenom."</td></tr>\n
            <tr><th>Publiée le :</th><td>".$r['datecreation']."</td></tr>\n
            </table>";
        }

        else {
            echo "
        <table style='color:#23272b;
                font-size: small;'>\n
        <tr><th>Titre de la recette : </th><td>".$r['titre']."</td></tr>\n
        <tr><th>Auteur de la recette :</th><td>".$nom." ".$prenom."</td></tr>\n
        <tr><th>Publiée le :</th><td>".$r['datecreation']."</td></tr>\n
        
    </table>\n";
        }

    ?>
    <br/>
    <br/>
    <h style="font-weight: bold;">Ingredients :</h>
    <br/>
    <?php
        $sql="SELECT * FROM `listeingredients` WHERE id_recette=".$ID;
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
                    echo "<input type=\"number\" name=\"qte_".$r['ingredient']."\" value=\"".$r['qte']."\" style='width:50px; height:25px;'/>\n
                      <input type=\"text\" name=\"unit_".$r['ingredient']."\" value=\"".$r['unit']."\" style='width:80px; height:25px;'/>\n   "
                        .$r['ingredient']."\n";
                }
                echo "<input type=\"submit\" name=\"submit\" value=\"Appliquer\"/></form>\n";
            }
            if ($action=="ajouter"){
                foreach ($result as $r){
                    echo "<li>".$r['qte'].$r['unit']."  ".$r['ingredient']." <br/>\n";
                }
                echo "<form method=\"post\" action=\"update.php?id=".$ID."&obj=".$obj."&action=ajouter\">\n
                <input type=\"number\" name=\"qte\" value=\"0\" style='width:50px; height:25px;'/>\n
                <input type=\"text\" name=\"unit\" value=\"\" style='width:80px; height:25px;'/>\n
                <input type=\"text\" name=\"ingredient\" value=\"ingredient\" style='width:120px; height:25px;'/>\n
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

        echo "<br/>\n
        <br/><h style=\"font-weight: bold;\">Etapes :</h>";

        $sql="SELECT * FROM listeetapes WHERE id_recette=".$ID;
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

        include ('functions/disconnect_bdd.php');
    ?>
    <br/><h> Notez cette recette !</h><br/>
    <form method="post" action="<?php echo 'noterRecette.php?id='.$ID.'&utilisateur='.$_SESSION['id_user'] ?>">
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
    <?php
    include "functions/connect_bdd.php";
    $sql="SELECT note FROM notes WHERE id_recette=?";
    $arr=array($ID);
    include "functions/select_from_bdd.php";
    if ($arr){
        $nb_notes=0;
        $notes=0;
        foreach ($result as $r){
            $note=$r['note'];
            $notes=$notes+$note;
            $nb_notes=$nb_notes+1;
        }
        if ($nb_notes>0){
            $notes=$notes/$nb_notes;
            $notes=sprintf("%.2f",$notes);
            echo "Note de la recette : ".$notes."/5";
        }

    }
    ?>
</section>
</html>



