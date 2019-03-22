<?php
echo "<meta name='author' content='BOUCHAIRA Katrennada and MAACHOU Marouane'>";
function connectbdd(){
try{
    //on se connecte à MySQL
    return new PDO('mysql:host=localhost;dbname=projet', 'root', 'mysqlPwd');
   }
   catch (Exception $e)
   {
    // en cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
   }
}
?>
