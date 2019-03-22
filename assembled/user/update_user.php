<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])){
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    $id_user=$_SESSION['id_user'];
}
include ('../../fonct2/functions/connect_bdd.php');

$obj=$_GET['obj'];
switch($obj){
    case "mail":
        $sql="SELECT * FROM users WHERE email=?";
        $arr=array($_POST['new_mail']);
        include "functions/select_from_bdd.php";
        if (!$result){
            $sql="update users set email=? where id_user = ?  ";
            $req=$pdo->prepare($sql);
            $req->execute(array($_POST['new_mail'],$id_user));
            if (isset($_SESSION['failed_mail'])){
                if ($_SESSION['failed_mail']){
                    $_SESSION['failed_mail']=0;
                }
            }
        }
        else {
            $_SESSION['failed_mail']=1;
        }

        break;

    case "nom":
        $sql="update users set nom=? where id_user = ?  ";
        $req=$pdo->prepare($sql);
        $req->execute(array($_POST['new_nom'],$id_user));
        break;

    case "prenom":
        $sql="update users set prenom=? where id_user = ?  ";
        $req=$pdo->prepare($sql);
        $req->execute(array($_POST['new_prenom'],$id_user));
        break;

    case "mdp":
        $sql="update users set pword=? where id_user = ?  ";
        $req=$pdo->prepare($sql);
        $req->execute(array(MD5($_POST['new_mdp']),$id_user));
        break;
}
header("Location:modif.php");