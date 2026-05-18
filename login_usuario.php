<?php

$host = "mysql.railway.internal";
$usuario = "root";
$contrasena = "zSQKsZdyqcdENHdiBMNORYApqMPogRUz";
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

$sql = "SELECT * FROM usuarios 
        WHERE nombre = '$nombre' 
        AND correo = '$correo' 
        AND contrasena = '$contrasena_usuario'";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    echo "Login correcto";
} else {
    echo "Datos incorrectos";
}

$conn->close();

?>