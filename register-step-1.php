<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthdate = $_POST['birthdate'];

    try {
        $stmt = $conn->prepare("INSERT INTO users (email, password, birthdate) VALUES (?, ?, ?)");
        $stmt->execute([$email, $password, $birthdate]);
        $userId = $conn->lastInsertId();

        // Redirigir al paso 2
        header("Location: register-step-2.html?user_id=" . $userId);
        exit();
    } catch (PDOException $e) {
        echo "Error en registro: " . $e->getMessage();
    }
}
?>