<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    $req=$pdo->prepare($sql);
    $req->execute($arr);
    $result=$req->fetchAll(PDO::FETCH_ASSOC);