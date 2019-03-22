
<html>
    <form method="post" action="research.php">
        <input type="text" name="search-query" placeholder="Cherchez une recette..."/>
        <input type="submit" name="submit" value="Chercher"/>
    </form>

</html>
<?php
    include ('functions/connect_bdd.php');
    if ($_POST){
        if (isset($_POST['search-query'])){
            $search_query=$_POST['search-query'];
            if (strlen($search_query)<3 or $search_query=="aux"){
                echo "Pas de resultat !";
            }
            // Séparation de la phrase en mots clés
            $key_words=explode(" ",$search_query);
            $ids=array();
            foreach ($key_words as $key){
                // Ne pas prendre en considération les mots constitués de deux lettres et le mot aux
                if (strlen($key)>2 and $key!="aux") {
                    // Recherche dans la base de données un titre de recette incluant un des mots clés
                    $sql="SELECT titre,ID FROM recettes WHERE titre LIKE '".$key."%' UNION
                          SELECT titre, ID FROM recettes WHERE titre LIKE '%".$key."'";
                    $arr=array();
                    include "functions/select_from_bdd.php";
                    // Recherche dans la base de données un ingrédient incluant un des mots clés et selection de la recette
                    $sql2="SELECT ID_recette FROM listeingredients WHERE ingredient LIKE '".$key."%' UNION
                          SELECT ID_recette FROM listeingredients WHERE ingredient LIKE '%".$key."'";
                    $req2=$pdo->prepare($sql2);
                    $req2->execute(array());
                    $result2=$req2->fetchAll(PDO::FETCH_ASSOC);
                    if (!$result and !$result2){
                        echo "Pas de resultat !\n";
                    }
                    foreach ($result as $r){
                        $titre=$r['titre'];
                        $id=$r['ID'];
                        // Ajouter les titres distincts des recettes sous forme de lien vers leur contenus
                        if (!in_array($id,$ids))
                        {
                            echo "<a href=\"contenuRecette.php?id=".$id."\">".$titre."</a><br/>\n";
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
                            echo "<a href=\"contenuRecette.php?id=".$id."\">".$titre."</a><br/>\n";
                            array_push($ids,$id);
                        }
                    }
                }
            }
        }
    }
    include ('functions/disconnect_bdd.php');
?>