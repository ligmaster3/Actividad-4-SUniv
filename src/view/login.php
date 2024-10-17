<?php

include '/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/config/conexion.php'; // 

// Función para validar el inicio de sesión
function validarLogin($email, $password)
{
    global $conn; // Asegúrate de que la variable $conn esté disponible
    $sql = "SELECT user_id, email_user, password_user FROM usuario WHERE email_user = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar el resultado obtenido

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verificación de la contraseña
        if (password_verify($password, $user['password_user'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email_user'];
            return true;
        } else {
            echo "La contraseña no coincide.<br>";
        }
    } else {
        echo "No se encontró un usuario con ese email.<br>";
    }
    return false;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Depuración: Mostrar el email y la contraseña
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Contraseña ingresada: " . htmlspecialchars($password) . "<br>";

    if (validarLogin($email, $password)) {
        echo "Inicio de sesión exitoso";
        // Redirigir después de 1 segundo
        header("Refresh:1; url=/src/public/dashboards.php");
        exit();
    } else {
        echo "Credenciales inválidas";
    }
}

?>