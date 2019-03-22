
<?php
// connexion à la base de données
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
include ('../../fonct2/functions/connect_bdd.php');
$bdd = $pdo;

$sql="SELECT id_user, nom, prenom, statut, email FROM users WHERE email!='admin@gmail.com'";
$arr=array();
include "functions/select_from_bdd.php";
echo "<div style='visibilty:hdden;'><table style='table-layout: fixed;
  width: 100%;
  height:20%;
  border-collapse: collapse;
  font-size:small;'>
    <thead>
        <tr>
            <th style='width: 80%;'>Nom</th>
            <th style='width: 80%;'>Prenom</th>
            <th style='width: 130%;'>Mail</th>
            <th style='width: 80%;' >Statut</th>
            <th style='width: 80%;'>Action</th>
            <th style='width: 80%;'>Consulter les recettes de l'utilisateur</th>
        </tr>
    </thead>
            <tbody>";
foreach ($result as $user){
    echo "
    <tr>
        <td style='width: 80%;'>".$user['nom']."</td>
        <td style='width: 80%;'>".$user['prenom']."</td>
        <td style='width: 130%;'>".$user['email']."</td>
        <td style='width: 80%;'>".$user['statut']."</td>
        <td style='width: 80%;' ><a href='action_on_user.php?id=".$user['id_user']."&action=delete'><img src=\"delete-button.png\" width='15' height='15'/></a><a href='action_on_user.php?id=".$user['id_user']."&action=block'><img src=\"bloquer.jpg\" width='15' height='15' /></a></td>
        <td><a href='recettes_user.php?id=".$user['id_user']."'>Recettes</a></td>
    </tr>
    ";
}
echo "</tbody></table></div>";
