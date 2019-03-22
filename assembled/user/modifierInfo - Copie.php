<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
<aside style="width: 40%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>
</aside>
<section style="
    color:#23272b;
">
<body id='first'>
<p> Les informations de votre compte : </p><br/>

</body>

<?php
@session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])){
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    $id_user=$_SESSION['id_user'];
}
include ('../../fonct2/functions/connect_bdd.php');
$sql="SELECT * FROM users WHERE id_user=?";
$arr=array($id_user);
include ('../../fonct2/functions/select_from_bdd.php');
echo "\n<br/><br/>\n";
$r=$result[0];
$obj=$_GET['obj'];
switch ($obj){
    case "mail":
        echo "
          <table>
            <tr><th>Adresse mail : </th>
            <td>
                <form method='post' action='update_user.php?obj=mail'>
                <input type='text' placeholder=".$r['email']." name='new_mail'/>
                <input type='submit' name='valider'/></form></td></tr>
            <tr><th>Nom :  </th><td>".$r['nom']."  </td></tr>
            <tr><th>Prenom : </th><td>".$r['prenom']."  </td></tr>
            <tr><td><a href=\"modifierInfo.php?obj=mdp\">Changer le mot de passe </a></td></tr>
          </table>";

        break;

    case "nom":
        echo "
           <table>
            <tr><th>Adresse mail : </th><td>".$r['email']."</td></tr>
            <tr><th>Nom :  </th>
            <td>
                <form method='post' action='update_user.php?obj=nom'>
                <input type='text' placeholder=".$r['nom']." name='new_nom' style='width: 120px;'/>
            <input type='submit' name='valider'/></form></td></tr>
            <tr><th>Prenom : </th><td>".$r['prenom']."  </td></tr>
            <tr><td><a href=\"modifierInfo.php?obj=mdp\">Changer le mot de passe </a><td/><tr/>
          </table>";
        break;

    case "prenom":
        echo "
           <table>
            <tr><th>Adresse mail : </th><td>".$r['email']."</td></tr>
            <tr><th>Nom :  </th><td>".$r['nom']."  </td></tr>
            <tr><th>Prenom : </th>
            <td>
                <form method='post' action='update_user.php?obj=prenom'>
                <input type='text' placeholder=".$r['prenom']." name='new_prenom' style='width: 120px;'/>
                <input type='submit' name='valider'/></form></td></tr>
            <tr><td><a href=\"modifierInfo.php?obj=mdp\">Changer le mot de passe </a><td/><tr/>
          </table>";
        break;

    case "mdp":
        echo "
           <table>
            <tr><th>Nouveau mot de passe : <th/>
            <td>
                <form method='post' action='update_user.php?obj=mdp'>
                <input type='password' name='new_mdp'  style='width: 120px;'/>
                <input type='submit' name='valider'/></form></td><tr/>
          </table>";
        break;
}

?>
</section>
</html>