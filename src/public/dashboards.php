<?php
// Iniciar la sesión
session_start();

include "/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/src/view/conexion.php";
include '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido']; 
    $correo = $_POST['correo'];
    $evento_id = $_POST['evento_id'];

    $sql_insert = "INSERT INTO inscripciones (evento_id, nombre, apellido, correo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("isss", $evento_id, $nombre, $apellido, $correo);

    if ($stmt->execute()) {
        header("Location: inscribir_evento.php?id=" . $evento_id . "&success=1");
        exit;
    } else {
        echo "Error al guardar la inscripción.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['email_user']) && isset($_POST['password'])) {
		$correo = $_POST['email_user'];
		$contrasena = $_POST['password'];

		// Llamar a la función de validación

		if ($usuario) {
			// Mostrar los datos del usuario si el login es exitoso
			echo "<div class='alert alert-success'>¡Inicio de sesión exitoso!</div>";
			echo "Bienvenido, " . htmlspecialchars($usuario['user_name']) . " " . htmlspecialchars($usuario['last_user']) . "<br>";
			echo "Edad: " . htmlspecialchars($usuario['edad_user']) . "<br>";
			echo "Email: " . htmlspecialchars($usuario['email_user']) . "<br>";

			// Redirigir al dashboard después de 2 segundos
			exit();
		} else {
			// Mostrar un mensaje de error y redirigir al login si hay credenciales inválidas
			echo "<div class='alert alert-danger'>Credenciales inválidas. Inténtalo nuevamente.</div>";
			$error = 'verifique que los datos sean correctos';
			exit();
		}
	}
}


// Mostrar los registros de la tabla "estudiante"
$sql = "SELECT 
    CONCAT(E.nombre, ' ', E.apellido) AS Usuario,
    E.correo AS Email,
    E.carrera AS Carrera,
    P.nombre AS Profesor,
    I.anio_curso AS Año,
    I.fecha_inscripcion AS `Fecha de Inscripción`
    FROM 
        Estudiantes E
    JOIN 
        Inscripciones I ON E.id_estudiante = I.id_estudiante
    JOIN 
        Cursos C ON I.id_curso = C.id_curso
    JOIN 
        Profesores P ON C.id_profesor = P.id_profesor";

    $result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="shortcut icon" href="/assets/img/logo/image+base46,fage4.png">

    <link rel="stylesheet" type="text/css" href="/src/css/style.css">

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
    <!-- <script src="/src/public/js/script.js" async></script> -->
</head>

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
                            <a class="dropdown-item d-flex pl-1" href="/src/view/login.php">
                                <div class="dropdown-item-icon px-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M16 17l5-5-5-5m6 5H3"></path>
                                    </svg>
                                </div>
                                <a href="logout.php">Cerrar sesión</a>
                            </a>
                            <?php else: ?>
                            <a class="dropdown-item d-flex pl-1" href="/src/view/login.php">
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



    <!-- Código para mostrar la lista de estudiantes registrados -->
    <div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between flex-nowrap">
            <h1 class="my-4">Lista de Estudiantes Registrados</h1>
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
                    <th>Estudiante</th>
                    <th>Email</th>
                    <th>Carrera</th>
                    <th>Profesor</th>
                    <th>Año</th>
                    <th class="text-center">Fecha de Inscripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
            $estudiante = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($estudiante as $estudiante): ?>
                <tr>
                    <td><?php echo htmlspecialchars($estudiante['Usuario']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['Email']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['Carrera']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['Profesor']); ?></td>
                    <td><?php echo htmlspecialchars($estudiante['Año']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($estudiante['Fecha de Inscripción']); ?></td>
                    <td class="text-center">
                        <a href="" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No se encontraron registros.</p>
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
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Estudiante</label>
                            <input type="text" class="form-control" id="e.nombre" name="e.nombre"
                                placeholder="Ingrese el Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido del Estudiante</label>
                            <input type="text" class="form-control" id="e.apellido" name="e.apellido"
                                placeholder="Ingrese el Apellido" required>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email del Estudiantes</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="e.email"
                                placeholder="Ingrese el Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="curso" class="form-label">Nombre del carrera</label>
                            <input name="carrerass" list="carreras" type="search" />
                            <datalist id="carreras">
                                <option value="Enfermeria"></option>
                                <option value="Educacion Fisica"></option>
                                <option value="Ingles"></option>
                                <option value="Informatica"></option>
                                <option value="Matematicas"></option>
                                <option value="Maestria"></option>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="profesor" class="form-label">Nombre del Profesor</label>
                            <input type="text" class="form-control" id="p.profesor" name="p.profesor"
                                placeholder="Ingrese el Profesor" required>
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" class="form-control" id="a.anio" name="a.anio"
                                placeholder="Ingrese el año cursado" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" name="btnRegistrar">Guardar
                            Registro</button>
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