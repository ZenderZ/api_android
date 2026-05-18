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

$sql = "SELECT id_usuario, nombre, correo FROM usuarios 
        WHERE nombre = '$nombre' 
        AND correo = '$correo' 
        AND contrasena = '$contrasena_usuario'";

$resultado = $conn->query($sql);

header("Content-Type: application/json");

if ($resultado->num_rows > 0) {
    $usuario_encontrado = $resultado->fetch_assoc();

    echo json_encode([
        "estado" => "correcto",
        "id_usuario" => $usuario_encontrado["id_usuario"],
        "nombre" => $usuario_encontrado["nombre"],
        "correo" => $usuario_encontrado["correo"]
    ]);
} else {
    echo json_encode([
        "estado" => "incorrecto"
    ]);
}

$conn->close();

?>