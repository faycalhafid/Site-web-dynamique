<?php

if (isset($_POST['ID']) && isset($_POST['ID']) != "") {
    require 'lib.php';
    $user_id = $_POST['ID']; 
    $object = new CRUD(); 
    echo $object->Details($user_id);
}
?>
