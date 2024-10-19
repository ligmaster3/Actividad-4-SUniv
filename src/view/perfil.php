if ($password_ingresada === $password_en_base_datos) {
// La contraseña es correcta, pero no está hasheada. Proceder a hashearla.
$hashed_password = password_hash($password_ingresada, PASSWORD_DEFAULT);

// Actualizar la contraseña en la base de datos con el hash
$query = "UPDATE users SET password = ? WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $hashed_password, $id);
$stmt->execute();

// Iniciar sesión
$_SESSION['user_id'] = $id;
$_SESSION['email_user'] = $email_user;

header("Location: /src/view/dashboard.php");
exit;
} else {
// Contraseña incorrecta
$error = "La contraseña es incorrecta.";
}