<?php 

require __DIR__.'/../vendor/autoload.php';


$selectedDataBase = 'mysql';

if ($selectedDataBase == 'redis') {
    require 'redis.php';
} else if ($selectedDataBase == 'mysql') {
    require 'mysql.php';
}
