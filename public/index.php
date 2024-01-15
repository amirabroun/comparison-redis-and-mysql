<?php

require __DIR__ . '/../vendor/autoload.php';

$selectedDataBase = 'redis';

if ($selectedDataBase == 'redis') {
    require './databases/redis.php';

    testRedis();
}

if ($selectedDataBase == 'mysql') {
    require './databases/redis.php';

    testMysql();
}
