<?php
    $res=$pdo->prepare($sql);
    $res->execute($arr);