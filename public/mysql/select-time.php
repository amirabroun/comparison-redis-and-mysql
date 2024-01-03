<?php


$query = "SELECT * FROM users";

$startTime = microtime(true);
$result = $PDO->query($query, PDO::FETCH_OBJ)->fetchAll();
$endTime = microtime(true);

$selectTime = (float) number_format($endTime - $startTime, 5);
