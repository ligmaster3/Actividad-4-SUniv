<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$server = "localhost";
$user = "root";
$password = "";
$database = "registros_academicos";

$conn = new mysqli($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta preparada para evitar SQL injection
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellido, edad, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $nombre, $apellido, $edad, $correo, $contrasena);

    if ($stmt->execute()) {
        // Guardar el usuario en la sesión después de registrarse
        $_SESSION['usuario'] = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $correo
        ];
        echo '<div class="alert alert-success">Registro exitoso</div>';
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Mostrar los registros de la tabla "usuario"
$sql = "SELECT id, nombre, apellido, edad, email FROM usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="shortcut icon" href="/assets/img/logo/image+base46,fage4.png">

    <link rel="stylesheet" type="text/css" href="/src/public/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/src/public/js/script.js" async></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary-subtle">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema Virtual</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mis Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Trabajos</a>
                        </li>
                    </ul>

                    <!-- Avatar -->
                    <div class="nav-item dropdown">
                        <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle" style="width: 40px; height: 40px;"
                                src="/assets/img/logo/profile-1.png" alt="User Avatar">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header d-flex align-items-center">
                                <img class="rounded-circle me-3" style="width: 50px; height: 50px;"
                                    src="/assets/img/logo/profile-1.png" alt="User Avatar">
                                <div>
                                    <?php
                                        if (isset($_SESSION['usuario'])) {
                                            $nombre = $_SESSION['usuario']['nombre'];
                                            $apellido = $_SESSION['usuario']['apellido'];
                                            $email = $_SESSION['usuario']['email'];
                                        } else {
                                            $nombre = "Invitado";
                                            $apellido = "";
                                            $email = "No disponible";
                                        }
                                        ?>
                                    <span class="dropdown-user-details-name">
                                        <?php echo $nombre . " " . $apellido; ?>
                                    </span><br>
                                    <span class="dropdown-user-details-email">
                                        <?php echo $email; ?>
                                    </span>
                                </div>
                            </h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex pl-1" href="#!">
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>
                                </div>
                                <p>
                                    Account
                                </p>
                            </a>
                            <a class="dropdown-item d-flex pl-1" href="#!">
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                </div>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Código para mostrar la lista de usuarios registrados -->
    <div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between flex-nowrap">
            <h1 class="my-4">Lista de Usuarios Registrados</h1>
            <!-- Botón que abre el modal del formulario de registro -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#registroAcademicoModal">
                Registrar
            </button>
        </div>

        <!-- Tabla con Bootstrap y DataTables -->
        <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Año</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nombre'] . " " . $usuario['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['anio']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['carrera']); ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No hay usuarios registrados.</p>
        <?php endif; ?>
    </div>

    <!-- Modal del Formulario de Registro Académico -->
    <div class="modal fade" id="registroAcademicoModal" tabindex="-1" aria-labelledby="registroAcademicoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroAcademicoLabel">Registro Académico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de Registro Académico -->
                    <form action="guardar_registro_academico.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Estudiante</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido del Estudiante</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="profesor" class="form-label">Nombre del Profesor</label>
                            <input type="text" class="form-control" id="profesor" name="profesor" required>
                        </div>
                        <div class="mb-3">
                            <label for="curso" class="form-label">Nombre del Curso</label>
                            <input type="text" class="form-control" id="curso" name="curso" required>
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" class="form-control" id="anio" name="anio" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

<?php
$conn->close();
?>