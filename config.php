<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$env = parse_ini_file(__DIR__ . '/.env', false, INI_SCANNER_RAW);

//var_dump($env); // <-- BUNU EKLEDİK

try {
    $pdo = new PDO(
        "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8mb4",
        $env['DB_USER'],
        $env['DB_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]
    );
   // echo "DB CONNECTED";
} catch (PDOException $e) {
    echo "<pre>";
    echo $e->getMessage();   // <-- ASIL HATA BURADA
    echo "</pre>";
    exit;
}




