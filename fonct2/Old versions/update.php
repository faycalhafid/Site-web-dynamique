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
    $sql="DELETE FROM recettes WHERE `ID`=?";
    $req=$pdo->prepare($sql);
    $req->execute(array($ID));
    header('Location: viewRecettes.php');
}

if ($obj=="titre")
{
    $titre=$_POST['titre'];
    $sql="UPDATE recettes SET `titre`=? where `ID`=?";
    $req=$pdo->prepare($sql);
    $req->execute(array($titre,$ID));
    header('Location: contenuRecette.php?id='.$ID);
}
if($obj=="ingredients") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == "modifier") {
            $sql = "SELECT `ingredient` FROM listeingredients WHERE `ID_recette`=?";
            $req = $pdo->prepare($sql);
            $req->execute(array($ID));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $r) {
                $ingredient = $r['ingredient'];
                $name = "qte_" . $ingredient;
                $qte = $_POST[$name];
                $name2 = "unit_" . $ingredient;
                $unit = $_POST[$name2];
                $sql2 = "UPDATE listeingredients SET `unit`=?,`qte`=? WHERE `ID_recette`=? AND `ingredient`=?";
                $req2 = $pdo->prepare($sql2);
                $req2->execute(array($unit, $qte, $ID, $ingredient));
            }
        }

        if ($action == "ajouter") {
            if ($_POST) {
                $ID = $_GET['id'];
                $ingredient = $_POST['ingredient'];
                $qte = $_POST['qte'];
                $unit = $_POST['unit'];
                $sql = "INSERT INTO listeingredients(`ID_recette`,`ingredient`,`qte`,`unit`) VALUES (?,?,?,?)";
                $req = $pdo->prepare($sql);
                $req->execute(array($ID, $ingredient, $qte, $unit));
                header('Location: modifierRecette.php?id=' . $ID);
            }
        }

        if ($action=="supprimer"){
            if(isset($_GET['ing']))
            {
                $ingredient=$_GET['ing'];
                $ID=$_GET['id'];
                $sql="DELETE FROM listeingredients WHERE `ID_recette`=? AND `ingredient`=?";
                echo $sql;
                echo $ID.' ing -> '.$ingredient;
                $req= $pdo->prepare($sql);
                $req->execute(array($ID,$ingredient));
                echo $ingredient;
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
    //code ici
    $etape=$_POST['etape'];
    $sql="UPDATE listeetapes SET `etape`=? where `ID_recette`=? AND `num_etape`=?";
    $req=$pdo->prepare($sql);
    $req->execute(array($etape,$ID,$num_etape));
    header('Location: contenuRecette.php?id='.$ID);
}



if ($pdo){
    $pdo=NULL;
}