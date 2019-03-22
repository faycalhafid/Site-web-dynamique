<?php
    $req=$pdo->prepare($sql);
    $req->execute($arr);
    $result=$req->fetchAll(PDO::FETCH_ASSOC);