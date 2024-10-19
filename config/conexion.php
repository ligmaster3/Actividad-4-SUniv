<?php 


// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros_academicos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
} 
  


?>