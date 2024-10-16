<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>Sign up</title>

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

<body class="bg-primary">

    <!-- Article main content -->
    <article class="col-xs-12 maincontent">
        <header class="page-header  card">
            <h1 class="page-title">Registro</h1>
        </header>

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 container">
            <div class="panel panel-default container-xl">
                <div class="panel-body card">
                    <h3 class="thin text-center">Registra una nueva cuenta</h3>
                    <p class="text-center text-white">Si ya cuenta con un usuario, presione aqui. <a
                            href="/src/view/login.php">Login</a>.
                    </p>
                    <hr>
                    <form action="/src/view/dashboards.php" method="POST">
                        <div class="top-margin">
                            <label>Nombre</label>
                            <input type="text" name="user_name" class="form-control" required>
                        </div>
                        <div class="top-margin">
                            <label>Apellido</label>
                            <input type="text" name="last_user" class="form-control" required>
                        </div>
                        <div class="top-margin">
                            <label>Edad</label>
                            <input type="text" name="edad_user" class="form-control" required>
                        </div>
                        <div class="top-margin">
                            <label>Correo <span class="text-danger">*</span></label>
                            <input type="email" name="email_user" class="form-control" required>
                        </div>

                        <div class="row top-margin">
                            <div class="col-sm-6">
                                <label>Contraseña <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Confirmar Contraseña <span class="text-danger">*</span></label>
                                <input type="password" name="confirmar_contrasena" class="form-control" required>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center mt-4 mb-2 p-3">
                                <button type="submit" class="btn btn-primary w-50">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>

    <!-- /Article -->
    </div>
    </div>

</body>

</html>