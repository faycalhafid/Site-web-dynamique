<html>
<?php
$server="localhost";
$user="root";
$password='';
$bd="bddrecettes";
//connexion
try{
    $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e){
    die("Error : ".$e->getMessage());
}
$ID=$_GET['id'];
$obj=$_GET['obj'];
$sql="SELECT * FROM recettes WHERE ID=".$ID;
$req=$pdo->prepare($sql);
$nbResult=$req->execute();
$result=$req->fetchAll(PDO::FETCH_ASSOC);
$r=$result[0];
echo "<a href=\"contenuRecette.php?id=".$ID."\">Mode lecture</a><br/>\n";
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
<br/><br/><h>Ingredients : <a href="modifierRecette.php?id=<?php echo $ID; ?> ">Annuler</a></h><br/>
<?php
$sql="SELECT * FROM `listeingredients` WHERE ID_recette=".$ID;
$req=$pdo->prepare($sql);
$req->execute();
$result=$req->fetchAll(PDO::FETCH_ASSOC);
$action=$_GET['action'];
//<input type="text" name="'.$r['ingredient'].'" value="'.$r['ingredient'].'"/>
if ($obj=="ingredients")
{
    if ($action=="modifier"){
        echo '<form method="post" action="update.php?id='.$ID.'&obj='.$obj.'&action=modifier">';
        foreach($result as $r){
            echo '<input type="number" name="qte_'.$r['ingredient'].'" value="'.$r['qte'].'"/>
              <input type="text" name="unit_'.$r['ingredient'].'" value="'.$r['unit'].'"/>   '
                .$r['ingredient'].'<br/>';
        }
        echo '<input type="submit" name="submit" value="Appliquer"/></form>';
    }

    if ($action=="ajouter"){
        foreach ($result as $r){
            echo '<li>'.$r['qte'].$r['unit'].' '.$r['ingredient'].' <br/>';
        }
        echo '<form method="post" action="update.php?id='.$ID.'&obj='.$obj.'&action=ajouter">
        <input type="number" name="qte" value="0" />
        <input type="text" name="unit" value="" />
        <input type="text" name="ingredient" value="ingredient"/>
        <input type="submit" name="submit" value="Ajouter"/>';
    }
    if ($action=="supprimer"){
        foreach ($result as $r){
            //echo "<form method=\"post\" action=\"update.php?id=".$ID."&obj=".$obj."&action=supprimer&ing=".$r['ingredient']."\">\n";
            echo "<a href=\"update.php?id=".$ID."&obj=".$obj."&action=supprimer&ing=".$r['ingredient']."\">
<img src=\"delete-button.png\" width='15' height='15'></a>\n";
            //echo "<input type=\"submit\" name=\"submit\" value=\"Supprimer\"/>\n";
            echo $r['qte'].$r['unit']." ".$r['ingredient']."<br/>\n";
            //echo "</form>";
        }
    }
        

}
else
{
    foreach ($result as $r){
        echo '<li>'.$r['qte'].$r['unit'].' '.$r['ingredient'].' <br/>';
    }
}

echo ' <br/>';

$sql="SELECT * FROM listeetapes WHERE ID_recette=".$ID;
$req=$pdo->prepare($sql);
$req->execute();
$result=$req->fetchAll(PDO::FETCH_ASSOC);
if ($obj=="etape")
{
    if (isset($_GET['num'])){
        $num=$_GET['num'];

    }
    foreach($result as $r){
        if ($num==$r['num_etape'])
            {   echo '<br/><li><h> Etape '.$r['num_etape'].'<br/>';
                echo '<form method="post" action="update.php?id='.$ID.'&obj='.  $obj.'&num='.$num.'">
                      <input type="text" name="etape" value="'.$r['etape'].'" />
                      <input type="submit" name="submit" value="Appliquer"/>
</form>';
            }
        else {
            echo '<br/><li><h> Etape '.$r['num_etape'].'<br/>'.$r['etape'];
        }

}
}
else {
    foreach($result as $r){
        echo '<br/><li><h> Etape '.$r['num_etape'].'<br/>'.$r['etape'];
}
}

echo '<br/><br/><a href="viewRecettes.php">'.' Retour</a>';
if ($pdo){
    $pdo=NULL;
}
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



