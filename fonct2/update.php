<?php
    include "functions/connect_bdd.php";
    if(isset($_GET['id'])){
        if(isset($_GET['obj'])){
            $ID=$_GET['id'];
            $obj=$_GET['obj'];
        }
        else{
            die();
        }
    }
    else {
        die();
    }
    if ($obj=="recette"){
        // Supprimer la recette et rediriger vers l'affichage de la liste des recettes
        $sql="DELETE FROM recettes WHERE `id_recette`=?";
        $req=$pdo->prepare($sql);
        $req->execute(array($ID));
        header('Location: viewRecettes.php');
    }
    if ($obj=="titre")
    {
        //Modification du titre de la recette et rediretion vers le contenu de la recette
        $titre=$_POST['titre'];
        $sql="UPDATE recettes SET `titre`=? where `id_recette`=?";
        $req=$pdo->prepare($sql);
        $req->execute(array($titre,$ID));
        header('Location: contenuRecette.php?id='.$ID);
    }
    if($obj=="ingredients") {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action == "modifier") {
                //Mettre à jour la base de données pour tous les ingrédients de la recette
                $sql = "SELECT `ingredient` FROM listeingredients WHERE `id_recette`=?";
                $arr=array($ID);
                include "functions/select_from_bdd.php";
                foreach ($result as $r) {
                    $ingredient = $r['ingredient'];
                    $name = "qte_" . $ingredient;
                    $qte = $_POST[$name];
                    $name2 = "unit_" . $ingredient;
                    $unit = $_POST[$name2];
                    $sql2 = "UPDATE listeingredients SET `unit`=?,`qte`=? WHERE `id_recette`=? AND `ingredient`=?";
                    $req2 = $pdo->prepare($sql2);
                    $req2->execute(array($unit, $qte, $ID, $ingredient));
                }
            }
            if ($action == "ajouter") {
                //Ajout d'un ingrédient et redirection vers la page de modification de la recette
                if ($_POST) {
                    $ID = $_GET['id'];
                    $ingredient = $_POST['ingredient'];
                    $qte = $_POST['qte'];
                    $unit = $_POST['unit'];
                    $sql = "INSERT INTO listeingredients(`id_recette`,`ingredient`,`qte`,`unit`) VALUES (?,?,?,?)";
                    $arr=array($ID, $ingredient, $qte, $unit);
                    include "functions/pass_to_bdd.php";
                    header('Location: modifierRecette.php?id=' . $ID);
                }
            }
            if ($action=="supprimer"){
                if(isset($_GET['ing']))
                {
                    //Suppression de l'ingrédient souhaité et redirection vers la page de modification de la recette
                    $ingredient=$_GET['ing'];
                    $ID=$_GET['id'];
                    $sql="DELETE FROM listeingredients WHERE `id_recette`=? AND `ingredient`=?";
                    $arr=array($ID,$ingredient);
                    include "functions/select_from_bdd.php";
                }

                header('Location: modifierRecette.php?id='.$ID);
            }
        }
    }
    if($obj=="etape")
    {
        if(isset($_GET['num'])){
            $num_etape=$_GET['num'];
        }
        else{
            die();
        }
        //Modification de l'étape et redirection vers le contenu de la recette
        $etape=$_POST['etape'];
        $sql="UPDATE listeetapes SET `etape`=? where `id_recette`=? AND `num_etape`=?";
        $req=$pdo->prepare($sql);
        $req->execute(array($etape,$ID,$num_etape));
        header('Location: contenuRecette.php?id='.$ID);
    }
    include ("functions/disconnect_bdd.php");