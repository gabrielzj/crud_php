<?php
    // include 1 vez, poderia usar require_once
    include_once __DIR__ . '/vendor/autoload.php';
    // variaveis .env n sobrescrevem outras env variaveis
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    
    $db_host = $_ENV['DATABASE_HOST'];
    $db_user = $_ENV['DATABASE_USER'];
    $db_pass = $_ENV['DATABASE_PASSWORD'];
    $db_name = $_ENV['DATABASE_NAME'];

    // try-catch conexao com o banco usando PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    