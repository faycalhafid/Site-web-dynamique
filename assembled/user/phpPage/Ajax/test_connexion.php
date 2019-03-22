<?php

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
