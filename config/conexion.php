<?php 

session_start();

// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros_academicos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    echo "Error de conexión a la base de datos";
    die("Conexión fallida: " . $conn->connect_error);
}

?>