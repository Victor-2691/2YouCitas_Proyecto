<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

// var_dump($_POST);

// $perfilId = $_POST['id_cliente'];
// $usuarioId = $_POST['id_usuario'];

// $sql = 'INSERT INTO megusta_enviados (id_cliente, id_usuario) VALUES (?, ?)';
// $stmt = $db->prepare($sql);
// $stmt->execute([$perfilId, $usuarioId]);
$perfilId = $_POST['id_cliente'];
$usuarioId = $_SESSION['idcliente'];

$query = "INSERT INTO megusta_enviados (id_cliente, id_usuario) VALUES ('$perfilId', '$usuarioId')";

$resultado = mysqli_query($db, $query);

if (!$resultado) {
  die("Error al guardar el like: " . mysqli_error($db));
}

mysqli_close($db);
?>