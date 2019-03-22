<?php
include "functions/connect_bdd.php";
echo "<meta name='author' content='BOUCHAIRA Katrennada and MAACHOU Marouane'>";
@session_start();
$current_id=$_SESSION['id_user'];
if ($current_id==1){
    // Si c'est bien l'admin qui tente de faire l'action
    $id_user=$_GET['id'];
    $action=$_GET['action'];
    switch ($action){
        case "delete":
            $sql="SELECT id_recette FROM recettes WHERE id_user=?";
            $arr=array($id_user);
            include "functions/select_from_bdd.php";
            print_r($result);
            foreach ($result as $r){
                $ID=$r['id_recette'];
                include "functions/delete_recette.php";
            }
            $sql="DELETE FROM commentaires WHERE id_user=?";
            $req=$pdo->prepare($sql);
            $req->execute(array($id_user));
            $sql="DELETE FROM notes WHERE id_user=?";
            $req=$pdo->prepare($sql);
            $req->execute(array($id_user));
            $sql="DELETE FROM users WHERE id_user=?";
            $arr=array($id_user);
            $req=$pdo->prepare($sql);
            $req->execute($arr);
            break;

        case "block":
            $sql="UPDATE users SET `statut`=? WHERE id_user=? ";
            $arr=array("blocked",$id_user);
            $req=$pdo->prepare($sql);
            $req->execute($arr);
            break;
    }
    header("Location: admin2.php");
}
else {
    header("Location : index.php");
}