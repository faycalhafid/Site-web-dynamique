<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
<link rel="stylesheet" type="text/css" href="stars.css">
<aside style="width: 25%;
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
        @session_start();
        include('functions/connect_bdd.php');
        $ID=$_GET['id'];
        $sql="SELECT * FROM recettes WHERE id_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        $r=$result[0];
        $sql="SELECT nom, prenom FROM users WHERE id_user=?";
        $arr=array($r['id_user']);
        include('functions/select_from_bdd.php');
        $nom=$result[0]['nom'];
        $prenom=$result[0]['prenom'];
        if ($_SESSION['statut']!="visiteur"){
            $id_user=$_SESSION['id_user'];
            if ($r['id_user']==$id_user and $_SESSION['statut']!="blocked"){
                echo "<a href=\"modifierRecette.php?id=".$ID."\">Mode edition</a><br/>\n";
            }
        }

        echo "
        <table style='color:#23272b;
                font-size: small;'>\n
        <tr><th>Titre de la recette : </th><td>".$r['titre']."</td></tr>\n
        <tr><th>Auteur de la recette :</th><td>".$nom." ".$prenom."</td></tr>\n
        <tr><th>Publiée le :</th><td>".$r['datecreation']."</td></tr>\n
        
    </table>\n";

    ?>
        <br/><h style="font-weight: bold;">Ingredients :</h><br/>
    <?php
        $sql="SELECT * FROM `listeingredients` WHERE id_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        foreach ($result as $r){
            echo "<li>".$r['qte'].$r['unit']."  ".$r['ingredient']." <br/>\n";
        }
        echo "<br/>\n
        <br/><h style=\"font-weight: bold;\">Etapes :</h>";

        $sql="SELECT * FROM listeetapes WHERE id_recette=".$ID;
        $arr=array();
        include "functions/select_from_bdd.php";
        foreach($result as $r){
            echo "<br/>\n<li><h> Etape ".$r['num_etape']."<br/>\n".$r['etape'];
        }
        include ('functions/disconnect_bdd.php');
    ?>

        <?php



            if($_SESSION['statut']!="visiteur" and $_SESSION['statut']!="blocked")
            {echo "</br></br></br><h> Notez cette recette !</h><br/>
                <form method=\"post\" action=\"noterRecette.php?id=".$ID."&utilisateur=".$_SESSION['id_user']."\">
                    <fieldset class=\"rating\">
                        <input type=\"radio\" id=\"star5\" name=\"rating\" value=\"5\" /><label class = \"full\" for=\"star5\" title=\"Awesome - 5 stars\"></label>
                        <input type=\"radio\" id=\"star4half\" name=\"rating\" value=\"4.5\" /><label class=\"half\" for=\"star4half\" title=\"Pretty good - 4.5 stars\"></label>
                        <input type=\"radio\" id=\"star4\" name=\"rating\" value=\"4\" /><label class = \"full\" for=\"star4\" title=\"Pretty good - 4 stars\"></label>
                        <input type=\"radio\" id=\"star3half\" name=\"rating\" value=\"3.5\" /><label class=\"half\" for=\"star3half\" title=\"Meh - 3.5 stars\"></label>
                        <input type=\"radio\" id=\"star3\" name=\"rating\" value=\"3\" /><label class = \"full\" for=\"star3\" title=\"Meh - 3 stars\"></label>
                        <input type=\"radio\" id=\"star2half\" name=\"rating\" value=\"2.5\" /><label class=\"half\" for=\"star2half\" title=\"Kinda bad - 2.5 stars\"></label>
                        <input type=\"radio\" id=\"star2\" name=\"rating\" value=\"2\" /><label class = \"full\" for=\"star2\" title=\"Kinda bad - 2 stars\"></label>
                        <input type=\"radio\" id=\"star1half\" name=\"rating\" value=\"1.5\" /><label class=\"half\" for=\"star1half\" title=\"Meh - 1.5 stars\"></label>
                        <input type=\"radio\" id=\"star1\" name=\"rating\" value=\"1\" /><label class = \"full\" for=\"star1\" title=\"Sucks big time - 1 star\"></label>
                        <input type=\"radio\" id=\"starhalf\" name=\"rating\" value=\"0.5\" /><label class=\"half\" for=\"starhalf\" title=\"Sucks big time - 0.5 stars\"></label>
                    </fieldset>
                    <input type=\"submit\" name=\"submit\" value=\"Noter la recette\"/>
                </form>";
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

            }
        ?>
    <link rel="stylesheet" type="text/css" href="stars.css">


    <p style="font-weight: bold;"> Commentaires : </p>
        <div><?php include("comments.php");?></div>

    </section>
</html>



