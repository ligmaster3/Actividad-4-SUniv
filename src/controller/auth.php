<?php
session_start();
include '/src/view/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email_user'];
    $password = $_POST['password_user'];

    $sql = "SELECT * FROM usuario WHERE email_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_user'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: /src/public/home.php");
            exit();
        } else {
            header("Location: /src/public/login.php?error=Contraseña incorrecta");
        }
    } else {
        header("Location: /src/public/login.php?error=Usuario no encontrado");
    }
}
?>