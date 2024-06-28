<?php
include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$db_host = $_ENV['DATABASE_HOST'];
$db_user = $_ENV['DATABASE_USER'];
$db_pass = $_ENV['DATABASE_PASSWORD'];
$db_name = $_ENV['DATABASE_NAME'];

// conexao com o banco usando PDO
try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    throw new PDOException($e);
}
