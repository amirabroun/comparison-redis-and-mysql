<?php

function redis()
{
    $redis = new \Predis\Client([
        'scheme' => 'tcp',
        'host'   => getenv('REDIS_HOSTNAME'),
        'port'   => '6379',
    ]);

    return $redis;
}

function insertDataTime()
{
    $startTime = microtime(true);
    redis()->set(uniqid('redis-'), "[fateme][soosfi][fatemeSoofi][null][12345678]");
    $endTime = microtime(true);

    $setTime = (float) number_format($endTime - $startTime, 5);

    return $setTime;
}

function selectTime()
{
    $startTime = microtime(true);
    $value = redis()->keys("*");
    $endTime = microtime(true);

    $getTime = (float) number_format($endTime - $startTime, 5);

    return [$getTime, $value];
}

function testRedis()
{
    $insertTime = insertDataTime();

    [$selectTime, $result] = selectTime();

    var_dump([
        'Run time for set data:' => $insertTime,
        'Run time for get data:' => $selectTime,
        'data' => $result,
    ]);
}
