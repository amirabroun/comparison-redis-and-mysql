<?php

$client = new \Predis\Client([
    'scheme' => 'tcp',
    'host'   => getenv('REDIS_HOSTNAME'),
    'port'   => '6379',
]);

$startTime = microtime(true);
$client->set('foo', 'bar');
$endTime = microtime(true);

$setTime =  (float) number_format($endTime - $startTime, 5);

$startTime = microtime(true);
$value = $client->get('foo');
$endTime = microtime(true);

$getTime = (float) number_format($endTime - $startTime, 5);

var_dump([
    'Run time for set data:' => $setTime,
    'Run time for get data:' =>  $getTime
]);

