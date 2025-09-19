<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">
    <link rel="stylesheet" type="text/css" href="/src/css/form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/src/js/scipt.js"></script>
</head>
<?php
session_start();

include_once '../Actividad-4-SUniv/src/view/conexion.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email_user']) && isset($_POST['password'])) {
        $correo = trim($_POST['email_user']);
        $contrasena = trim($_POST['password']);

        // Validar formato de correo electrónico
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico no tiene un formato válido.";
        }


        if (empty($errores)) {
            // Preparar la consulta para seleccionar el usuario basado en el email
            $stmt = $conn->prepare("SELECT user_id, user_name, last_user, edad_user, email_user, password_user FROM usuario WHERE email_user = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                // Verifica la contraseña usando password_verify
                if (password_verify($contrasena, $user['password_user'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['last_user'] = $user['last_user'];
                    $_SESSION['edad_user'] = $user['edad_user'];
                    $_SESSION['email_user'] = $user['email_user'];
                    // Redirigir si todo es correcto
                    header("location: /src/public/home.php");
                    exit();
                } else {
                    $errores[] = "Contraseña incorrecta. Por favor, intente de nuevo.";
                }
            } else {
                $errores[] = "No se encontró ningún usuario con este correo electrónico.";
            }
        }
    } else {
        $errores[] = "Por favor complete ambos campos.";
    }
}
?>





<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Login</h3>
                                </div>
                                <p class="text-center text-white">Si no cuenta con un usuario, <a
                                        href="/src/view/Sign up.php">Regístrate</a> aquí</p>
                                <div class="card-body">
                                    <?php if (!empty($errores)): ?>
                                        <div class="alert alert-danger">
                                            <?php foreach ($errores as $error): ?>
                                                <li><?php echo $error; ?></li>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Login form-->
                                    <form method="POST" action="">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email"
                                                name="email_user" placeholder="Enter email address" required>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password"
                                                name="password" placeholder="Enter password" required>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>