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

$sql = "SELECT 
            u.id_usuario,
            u.nombre,
            u.correo,
            t.id_tarea,
            t.titulo,
            t.descripcion
        FROM usuarios u
        LEFT JOIN tareas t ON u.id_usuario = t.id_usuario
        ORDER BY u.id_usuario, t.id_tarea";

$resultado = $conn->query($sql);

$usuarios = [];

while ($fila = $resultado->fetch_assoc()) {
    $id = $fila["id_usuario"];

    if (!isset($usuarios[$id])) {
        $usuarios[$id] = [
            "id_usuario" => $fila["id_usuario"],
            "nombre" => $fila["nombre"],
            "correo" => $fila["correo"],
            "tareas" => []
        ];
    }

    if ($fila["id_tarea"] != null) {
        $usuarios[$id]["tareas"][] = [
            "id_tarea" => $fila["id_tarea"],
            "titulo" => $fila["titulo"],
            "descripcion" => $fila["descripcion"]
        ];
    }
}

header("Content-Type: application/json");
echo json_encode(array_values($usuarios));

$conn->close();

?>