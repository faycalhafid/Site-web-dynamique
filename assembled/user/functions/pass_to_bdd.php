<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    $res=$pdo->prepare($sql);
    $res->execute($arr);