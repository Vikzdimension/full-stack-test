<?php

$host = 'localhost';
$db = 'wpoets';
$user = 'root';
$pass = 'root@123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
    $pdo = new PDO($dsn, $user, $pass);
}catch(PDOException $e){
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}