<?php
// db_connect.php
$serverName = "RAFASPC"; 
$database = "syncu_db";
$username = "tu_usuario"; // AÑADIR
$password = "tu_password"; // AÑADIR

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>