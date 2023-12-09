<?php
// HANDLES PDO CONNECTIONS TO THE DATABASE

require_once __DIR__ . "/config.php";

try {
$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER . ";charset=utf8mb4" , DB_USER , DB_PASSWORD);

} catch (Exception $e) {

    die("Erreur :" . $e->getMessage());

}
?>