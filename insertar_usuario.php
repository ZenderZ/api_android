<?php

$host = "mysql.ferrocarril.interno";
$usuario = "raíz";
$password = "KWPXLGNpCKNMGddCIWIXbIaYsbAqkVS";
$database = "ferrocarril";

$conn = new mysqli($host, $usuario, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión");
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "INSERT INTO usuarios(nombre, correo, contrasena)
VALUES('$nombre', '$correo', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado";
} else {
    echo "Error";
}

$conn->close();

?>