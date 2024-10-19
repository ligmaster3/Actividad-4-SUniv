<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unachi/Sistema Universitario</title>

    <link rel="shortcut icon" href="/assets/img/logo/image+base46,fage4.png">
    <link rel="stylesheet" href="/src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/src/js/script.js" async></script>
</head>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros_academicos";

// Función para mostrar notificaciones
function showNotification($message, $type) {
    echo "<script>Toastify({
        text: '$message',
        duration: 3000,
        gravity: 'top',
        position: 'right',
        backgroundColor: '$type',
    }).showToast();</script>";
}

// Verificar si el usuario está logueado
if (isset($_SESSION['user_id'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT user_id, user_name, last_user, password_user FROM usuario WHERE email_user = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        showNotification("Error al preparar la consulta", '#dc3545');
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontró el usuario
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verifica si la contraseña es correcta
        if (password_verify($password, $user['password_user'])) {
            // Guardar los datos del usuario en la sesión
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['nombre'] = $user['user_name'];
            $_SESSION['apellido'] = $user['last_user'];

            showNotification("Login exitoso. Bienvenido, " . $user['user_name'] . "!", '#28a745');
            
            // Redirigir al index
            // header("Location: /index.php");
            exit;
        } else {
            showNotification("Contraseña incorrecta", '#dc3545');
        }
    } else {
        showNotification("No se encontró el usuario", '#dc3545');
    }

    // Cerrar declaración y conexión
    $stmt->close();
    $conn->close();

} else {
    // Usuario no logueado
    $nombre = "Invitado";
    $apellido = "";
    $email = "No disponible";
    showNotification('Usuario invitado', '#ffc107');
}

?>


<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary-subtle">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema Academico</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Cursos
                            </a>
                            <ul class="dropdown-menu bg-primary-subtle">
                                <li><a class="dropdown-item" href="#">Creditos</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Avatar y detalles de usuario -->
                    <div class="nav-item dropdown">
                        <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img class="rounded-circle" style="width: 40px; height: 40px;"
                                src="/assets/img/logo/profile-1.png" alt="User Avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header d-flex align-items-center">
                                <img class="rounded-circle me-3" style="width: 50px; height: 50px;"
                                    src="/assets/img/logo/profile-1.png" alt="User Avatar">
                                <div>
                                    <span
                                        class="dropdown-user-details-name"><?php echo $nombre . " " . $apellido; ?></span><br>
                                    <span class="dropdown-user-details-email"><?php echo $email; ?></span>
                                </div>
                            </h6>
                            <div class="dropdown-divider"></div>
                            <?php if (isset($_SESSION['user_id'])): ?>

                            <a class="dropdown-item d-flex pl-1" href="/src/view/perfil.php">
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M16 17l5-5-5-5m6 5H3"></path>
                                    </svg>
                                </div>
                                <p>
                                    Account
                                </p>
                            </a>
                            <a class="dropdown-item d-flex pl-1" href="/src/view/logout.php">
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M16 17l5-5-5-5m6 5H3"></path>
                                    </svg>
                                </div>
                                <p>
                                    Cerrar sesión
                                </p>
                            </a>
                            <?php else: ?>
                            <a class="dropdown-item d-flex pl-1" href="/src/public/sign in.php">
                                <!-- ... (puedes agregar un ícono de Login) ... -->
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M16 17l5-5-5-5m6 5H3"></path>
                                    </svg>
                                </div>
                                <p>Login</p>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <section>
            <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow">
                <div class="lh-1">
                    <h3>Bienvenido, <?= htmlspecialchars($nombre . ' ' . $apellido); ?>!</h3>
                    <p>Tu correo: <?= htmlspecialchars($email); ?></p>
                    <img src="/assets/img/logo/profile-1.png" alt="Avatar de <?= htmlspecialchars($nombre); ?>"
                        class="rounded-circle" width="150">
                    <h1 class="h6 mb-0 text-white lh-1">¡Hola, <?php echo $nombre; ?> 👋</h1>
                </div>
            </div>
        </section>
        <section id="">
            <!-- Contenido principal -->
        </section>
    </main>
</body>

</html>