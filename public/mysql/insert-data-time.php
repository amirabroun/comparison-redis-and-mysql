<?php

$rand = rand(0, 10);
$query = "INSERT INTO users (first_name, last_name, username, address, password)
VALUES ('fateme', 'soofi', 'fateme-soofi{$rand}', NULL, '12345678');";

$startTime = microtime(true);
$result = $PDO->query($query, PDO::FETCH_OBJ);
$endTime = microtime(true);


$insertTime = (float) number_format($endTime - $startTime, 5);
