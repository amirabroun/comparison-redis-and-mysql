<?php

$PDO = require './mysql/connect-db.php';

require './mysql/select-time.php';
require './mysql/insert-data-time.php';

var_dump([
    'Run time for set data:' => $insertTime,
], [
    'Run time for get data:' => $selectTime,
    'data' => $result,
]);
