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

$id_usuario = $data['id_usuario'];
$titulo = $data['titulo'];
$descripcion = $data['descripcion'];

$sql = "INSERT INTO tareas (id_usuario, titulo, descripcion)
VALUES ('$id_usuario', '$titulo', '$descripcion')";

if ($conn->query($sql) === TRUE) {

    echo "Tarea insertada correctamente";

} else {

    echo "Error: " . $conn->error;
}

$conn->close();

?>