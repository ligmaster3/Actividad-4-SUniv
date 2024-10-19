<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include "/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/config/conexion.php";

// Función para validar el inicio de sesión y devolver todos los datos del usuario
function validarLogin($email, $password) {
    global $conn;

    // Preparar la consulta para seleccionar el usuario basado en el email
    $stmt = $conn->prepare("SELECT user_id, user_name, last_user, edad_user, email_user, password_user FROM usuario WHERE email_user = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña usando password_verify()
        if ($password === $user['password_user']) {
            // Almacenar todos los datos del usuario en la sesión
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['last_user'] = $user['last_user'];
            $_SESSION['edad_user'] = $user['edad_user'];
            $_SESSION['email_user'] = $user['email_user'];

            // Retornar los datos del usuario
            return $user;
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">La contraseña no es correcta.</div>';
        }
    } else {
        echo 'No se encontró un usuario con ese correo electrónico.<br>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email_user']) && isset($_POST['password'])) {
        $correo = $_POST['email_user'];
        $contrasena = $_POST['password'];

        // Llamar a la función de validación
        $usuario = validarLogin($correo, $contrasena);

        if ($usuario) {
            // Guardar los datos del usuario en la sesión
            $_SESSION['user_id'] = $usuario['user_id'];
            $_SESSION['user_name'] = $usuario['user_name'];
            $_SESSION['last_user'] = $usuario['last_user'];
            $_SESSION['email_user'] = $usuario['email_user'];

            // Mostrar los datos del usuario
            echo "Inicio de sesión exitoso.<br>";
            echo "Bienvenido, " . htmlspecialchars($usuario['user_name']) . " " . htmlspecialchars($usuario['last_user']) . "<br>";
            echo "Edad: " . htmlspecialchars($usuario['edad_user']) . "<br>";
            echo "Email: " . htmlspecialchars($usuario['email_user']) . "<br>";

            // Redirigir al dashboard después de 2 segundos
            // header("Refresh:2; url=/src/public/dashboards.php");
            exit();
        } else {
           header('include "";');
        }
    }
}
?>