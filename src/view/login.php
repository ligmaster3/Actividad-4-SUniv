<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="shortcut icon" href="/assets/img/logo/users-alt (1).png">
    <link rel="stylesheet" type="text/css" href="/src/public/css/form.css">

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
                                <p class="text-center text-muted">Si no cuenta con un usuario, <a
                                        href="../pages/view/signup.php">Registrate</a>aqui</p>
                                <div class="card-body">
                                    <!-- Login form-->
                                    <?php
                                    // Verificar si el formulario ha sido enviado
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        $server = "localhost";
                                        $user = "root";
                                        $password = "";
                                        $database = "registros_academicos";// Incluye la conexión a la base de datos

                                        $email = $_POST['email'];
                                        $password = $_POST['password'];

                                        // Consulta para verificar el correo y obtener la contraseña encriptada
                                        $sql = "SELECT id, password FROM usuario WHERE email = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $email);
                                        $stmt->execute();
                                        $stmt->store_result();

                                        // Verifica si se encontró el usuario
                                        if ($stmt->num_rows == 1) {
                                            // Vincula los resultados de la consulta
                                            $stmt->bind_result($id, $hashed_password);
                                            $stmt->fetch();

                                            // Verificar la contraseña
                                            if (password_verify($password, $hashed_password)) {
                                                // Iniciar sesión si la contraseña es correcta
                                                if (session_status() == PHP_SESSION_NONE) {
                                                    session_start();  // Iniciar sesión solo si no está iniciada
                                                }
                                                
                                                // Guardar el ID del usuario en la sesión
                                                $_SESSION['user_id'] = $id;
                                                
                                                // Redirigir al dashboard
                                                header("Location: dashboard.php");
                                                exit;
                                            } else {
                                                echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger'>No se encontró el usuario.</div>";
                                        }

                                        $stmt->close();
                                        $conn->close();
                                    }
                                    ?>
                                    <form method="POST" action="">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                                placeholder="Enter email address" required>
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