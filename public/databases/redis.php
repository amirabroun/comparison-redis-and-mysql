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
    $startTime = microtime(true);
    redis()->set('foo', 'bar');
    $endTime = microtime(true);

    $setTime =  (float) number_format($endTime - $startTime, 5);

    return $setTime;
}

function getDataFromRedis()
{
    $startTime = microtime(true);
    $value = redis()->get('foo');
    $endTime = microtime(true);

    $getTime = (float) number_format($endTime - $startTime, 5);

    return [$getTime, $value];
}
