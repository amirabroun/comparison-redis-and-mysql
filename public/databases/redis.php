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

function insertDataWithRedis()
{
    $id = rand(0, 100);

    $startTime = microtime(true);
    redis()->set($id, "[fateme][soosfi][fatemeSoofi][null][12345678]");
    $endTime = microtime(true);

    $setTime = (float) number_format($endTime - $startTime, 5);

    return [$setTime, $id];
}

function getDataFromRedis($id)
{
    $startTime = microtime(true);
    $value = redis()->get($id);
    $endTime = microtime(true);

    $getTime = (float) number_format($endTime - $startTime, 5);

    return [$getTime, $value];
}
