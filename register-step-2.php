<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $fullName = $_POST['fullName'];
    $studentType = $_POST['student-type'];
    $university = $_POST['university'];
    $career = $_POST['career'];
    $careerYear = $_POST['careerYear'];
    $countryOrigin = $_POST['countryOrigin'];
    $languages = $_POST['languages'];
    $aboutMe = $_POST['aboutMe'] ?? null;

    // Subir foto de perfil
    $profilePic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $uploadDir = 'uploads/profile_pics/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = $userId . '_' . basename($_FILES['profile_pic']['name']);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath)) {
            $profilePic = $filePath;
        }
    }

    try {
        $stmt = $conn->prepare("INSERT INTO profiles (user_id, full_name, student_type, university, career, career_year, country_origin, languages, about_me, profile_pic)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId, $fullName, $studentType, $university, $career,
            $careerYear, $countryOrigin, $languages, $aboutMe, $profilePic
        ]);

        // Opcional: Crear entrada en social_links
        $stmt = $conn->prepare("INSERT INTO social_links (user_id) VALUES (?)");
        $stmt->execute([$userId]);

        echo "✅ Registro completado. <a href='sign-in.html'>Inicia sesión aquí</a>.";
    } catch (PDOException $e) {
        echo "Error al guardar perfil: " . $e->getMessage();
    }
}
?>