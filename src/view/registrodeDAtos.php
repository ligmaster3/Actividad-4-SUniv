<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$password = "";
$database = "Registros_academicos";

$conn = new mysqli($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $apellido_estudiante = $_POST['apellido_estudiante'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo_estudiante = $_POST['correo_estudiante'];
    $matricula = $_POST['matricula'];
    $nombre_profesor = $_POST['nombre_profesor'];
    $apellido_profesor = $_POST['apellido_profesor'];
    $correo_profesor = $_POST['correo_profesor'];
    $nombre_curso = $_POST['nombre_curso'];
    $descripcion_curso = $_POST['descripcion_curso'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $tipo_evaluacion = $_POST['tipo_evaluacion'];
    $descripcion_evaluacion = $_POST['descripcion_evaluacion'];
    $fecha_evaluacion = $_POST['fecha_evaluacion'];
    $nota = $_POST['nota'];

    // Consulta preparada para llamar al procedimiento almacenado
    $stmt = $conn->prepare("CALL InsertarDatosCompletos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssisssssd", 
        $nombre_estudiante, 
        $apellido_estudiante, 
        $fecha_nacimiento, 
        $correo_estudiante, 
        $matricula,
        $nombre_profesor, 
        $apellido_profesor, 
        $correo_profesor,
        $nombre_curso, 
        $descripcion_curso, 
        $fecha_inscripcion, 
        $tipo_evaluacion, 
        $descripcion_evaluacion, 
        $fecha_evaluacion, 
        $nota
    );

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Registro exitoso</div>';
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="/assets/img/logo/image+base46,fage4.png">

    <link rel="stylesheet" type="text/css" href="/src/public/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script src="/src/public/js/script.js" async></script> -->
</head>

<body>
    <div class="container mt-5 form-container shadow">
        <h1>Registro Académico</h1>

        <form action="insertar_datos.php" method="POST">
            <h3>Datos del Estudiante</h3>
            <div class="mb-3">
                <label for="nombre_estudiante" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" required>
            </div>
            <div class="mb-3">
                <label for="apellido_estudiante" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido_estudiante" name="apellido_estudiante" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="correo_estudiante" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo_estudiante" name="correo_estudiante" required>
            </div>
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" required>
            </div>

            <h3>Datos del Profesor</h3>
            <div class="mb-3">
                <label for="nombre_profesor" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre_profesor" name="nombre_profesor" required>
            </div>
            <div class="mb-3">
                <label for="apellido_profesor" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido_profesor" name="apellido_profesor" required>
            </div>
            <div class="mb-3">
                <label for="correo_profesor" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo_profesor" name="correo_profesor" required>
            </div>

            <h3>Datos del Curso</h3>
            <div class="mb-3">
                <label for="nombre_curso" class="form-label">Nombre del Curso:</label>
                <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_curso" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion_curso" name="descripcion_curso" rows="3"
                    required></textarea>
            </div>

            <h3>Datos de Inscripción</h3>
            <div class="mb-3">
                <label for="fecha_inscripcion" class="form-label">Fecha de Inscripción:</label>
                <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" required>
            </div>

            <h3>Datos de Evaluación</h3>
            <div class="mb-3">
                <label for="tipo_evaluacion" class="form-label">Tipo de Evaluación:</label>
                <input type="text" class="form-control" id="tipo_evaluacion" name="tipo_evaluacion" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_evaluacion" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion_evaluacion" name="descripcion_evaluacion" rows="3"
                    required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_evaluacion" class="form-label">Fecha de Evaluación:</label>
                <input type="date" class="form-control" id="fecha_evaluacion" name="fecha_evaluacion" required>
            </div>
            <div class="mb-3">
                <label for="nota" class="form-label">Nota:</label>
                <input type="number" class="form-control" id="nota" name="nota" min="0" max="100" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

</body>

</html>