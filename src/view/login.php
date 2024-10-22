<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include "/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/src/view/conexion.php";

// Función para validar el inicio de sesión y devolver todos los datos del usuario
function validarLogin($email, $password)
{
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
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">La contraseña es incorrecta.</div>';
            // header("Refresh:1; url=/src/public/sign in.php");
        }
    } else {
        echo "<div class='alert alert-danger'>Error en el correo electronico: " . $stmt->error . "</div>";
    }
}


session_start();
include "/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/src/view/conexion.php";

// Función que valida las credenciales de login
function validarLogi1n($correo, $contrasena)
{
    global $conn; // Supongo que $conexion es tu conexión a la base de datos
    $errores = [];

    // Verificar si los campos están vacíos
    if (empty($correo)) {
        $errores[] = "El campo de correo está vacío.";
    }
    if (empty($contrasena)) {
        $errores[] = "El campo de contraseña está vacío.";
    }
    // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)
    if (strlen($contrasena) < 8 || !preg_match("/[A-Za-z]/", $contrasena) || !preg_match("/[0-9]/", $contrasena)) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres y contener al menos una letra y un número.";
    }
    // Si hay errores en los campos vacíos, devolverlos
    if (!empty($errores)) {
        return $errores;
    }

    // Consulta SQL para verificar usuario y contraseña con los nuevos campos de la tabla
    $stmt = $conn->prepare("SELECT user_id, user_name, last_user, edad_user, email_user, password_user FROM usuario WHERE email_user = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si el usuario existe
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contrasena, $usuario['password_user'])) {

            // Guardar los datos del usuario en la sesión
            $_SESSION['id'] = $usuario['user_id'];
            $_SESSION['nombre'] = $usuario['user_name'];
            $_SESSION['apellido'] = $usuario['last_user'];
            $_SESSION['edad'] = $usuario['edad_user'];
            $_SESSION['email'] = $usuario['email_user'];


            return true;
        } else {
            // Contraseña incorrecta
            $errores[] = "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        $errores[] = "El correo no está registrado.";
    }

    return $errores;
}

$error = '';

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
            echo "<div class='alert alert-success'>¡Inscripción realizada con éxito!.</div>";
            echo "Bienvenido, " . htmlspecialchars($usuario['user_name']) . " " . htmlspecialchars($usuario['last_user']) . "<br>";
            echo "Edad: " . htmlspecialchars($usuario['edad_user']) . "<br>";
            echo "Email: " . htmlspecialchars($usuario['email_user']) . "<br>";

            // Redirigir al dashboard después de 2 segundos

            // header("Refresh:2; url=/src/public/dashboards.php");
            exit();
        } else {
            header('locatio: /src/view/login.php?error ');
        }
    }
}

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