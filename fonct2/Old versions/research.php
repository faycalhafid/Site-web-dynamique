
<html>
<form method="post" action="research.php">
    <input type="text" name="search-query" placeholder="Cherchez une recette..."/>
    <input type="submit" name="submit" value="Chercher"/>
</form>

</html>
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

if ($_POST){
    if (isset($_POST['search-query'])){
        $search_query=$_POST['search-query'];
        if (strlen($search_query)<3 or $search_query=="aux"){
            echo "Pas de resultat !";
        }
        $key_words=explode(" ",$search_query);
        $ids=array();
        foreach ($key_words as $key){
            if (strlen($key)>2 and $key!="aux") {
                $sql="SELECT titre,ID FROM recettes WHERE titre LIKE '".$key."%' UNION
                      SELECT titre, ID FROM recettes WHERE titre LIKE '%".$key."'";
                $req=$pdo->prepare($sql);
                $req->execute(array());
                echo "<br/><br/>";
                $result=$req->fetchAll(PDO::FETCH_ASSOC);

                $sql2="SELECT ID_recette FROM listeingredients WHERE ingredient LIKE '".$key."%' UNION
                      SELECT ID_recette FROM listeingredients WHERE ingredient LIKE '%".$key."'";
                $req2=$pdo->prepare($sql2);
                $req2->execute(array());
                $result2=$req2->fetchAll(PDO::FETCH_ASSOC);
                if (!$result and !$result2){
                    echo "Pas de resultat !";
                }
                foreach ($result as $r){
                    $titre=$r['titre'];
                    $id=$r['ID'];
                    if (!in_array($id,$ids))
                    {
                        echo "<a href=\"contenuRecette.php?id=".$id."\">".$titre."</a>";
                        array_push($ids,$id);
                    }

                }
                foreach ($result2 as $r){
                    $id=$r['ID_recette'];
                    if (!in_array($id,$ids))
                    {
                        $sql3="SELECT titre FROM recettes WHERE ID=".$id;
                        $req3=$pdo->prepare($sql3);
                        $req3->execute(array());
                        $result3=$req3->fetchAll(PDO::FETCH_ASSOC);
                        $titre=$result3[0]['titre'];
                        echo "<a href=\"contenuRecette.php?id=".$id."\">".$titre."</a>";
                        array_push($ids,$id);
                    }

                }
            }
        }

    }
}


if ($pdo){
    $pdo=NULL;
}
?>