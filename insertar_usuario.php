<?php

$host = "mysql.railway.internal";
$usuario = "root";
$contrasena = "KWPSXLGNpCKNMGddCIWIXbIaYsbAqkVS";
$base_datos = "railway";
$puerto = 3306;

$conn = new mysqli($host, $usuario, $contrasena, $base_datos, $puerto);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$correo = $data['correo'];
$contrasena_usuario = $data['contrasena'];

$sql = "INSERT INTO usuarios (nombre, correo, contrasena)
VALUES ('$nombre', '$correo', '$contrasena_usuario')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario insertado correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>