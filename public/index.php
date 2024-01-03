<?php

require __DIR__ . '/../vendor/autoload.php';

$selectedDataBase = 'mysql';

if ($selectedDataBase == 'redis') {
    [$selectTime, $result] = getDataFromRedis();

    var_dump([
        'Run time for set data:' => insertDataWithRedis(),
        'Run time for get data:' => $selectTime,
        'data' => $result,
    ]);
}

if ($selectedDataBase == 'mysql') {
    $insertTime = insertDataTime();
    [$selectTime, $result] = selectTime();

    var_dump([
        'Run time for set data:' => $insertTime,
        'Run time for get data:' => $selectTime,
        'data' => $result,
    ]);
}
