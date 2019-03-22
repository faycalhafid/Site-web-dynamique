
<?php
if (isset($_POST)) {
    require 'lib.php';
 
    $id = $_POST['id'];
    $newComm = $_POST['commentaire'];
 
    $object = new CRUD();
 
    $object->Update($newComm, $id);
}
