<?php

function pdo()
{
    $database = getenv('DB');
    $host = getenv('MARIADB_HOSTNAME');
    $port = '3306';
    $username = 'root';
    $password = 'password';

    $dsn = "mysql:host=$host;port=$port";

    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    try {
        $PDO = new PDO($dsn, $username, $password, $options);
        $databaseExists = $PDO->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'")->rowCount() > 0;

        if (!$databaseExists) {
            $PDO->exec("CREATE DATABASE $database;");
        }

        $dsn = "mysql:host=$host;port=$port;dbname=$database";
        $PDO = new PDO($dsn, $username, $password, $options);

        $checkTableQuery = "SELECT 1 FROM information_schema.tables WHERE table_schema = '$database' AND table_name = 'users'";
        $tableExists = $PDO->query($checkTableQuery)->fetchColumn();

        if (!$tableExists) {
            $createTableQuery = "
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255),
                last_name VARCHAR(255),
                username VARCHAR(255),
                address VARCHAR(255),
                password VARCHAR(255)
            )";

            $PDO->exec($createTableQuery);
        }
    } catch (\PDOException $error) {
        die($error->getMessage());
    }

    return $PDO;
}

function insertDataTime()
{
    $rand = rand(0, 10);
    $query = "INSERT INTO users (first_name, last_name, username, address, password)
              VALUES ('fateme', 'soosfi', 'fateme-soofi`$rand`', NULL, '12345678');";

    $startTime = microtime(true);
    pdo()->query($query);
    $endTime = microtime(true);

    $insertTime = (float) number_format($endTime - $startTime, 5);

    return $insertTime;
}

function selectTime()
{
    $query = "SELECT * FROM users";

    $startTime = microtime(true);
    $result = pdo()->query($query, PDO::FETCH_OBJ)->fetchAll();
    $endTime = microtime(true);

    $selectTime = (float) number_format($endTime - $startTime, 5);

    return [$selectTime, $result];
}

function testMysql()
{
    $insertTime = insertDataTime();
    [$selectTime, $result] = selectTime();

    var_dump([
        'Run time for set data:' => $insertTime,
        'Run time for get data:' => $selectTime,
        'data' => $result,
    ]);
}
