<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();


// $idperfil = $_GET['id'];
// $idusuario = $_GET['iduser'];

// // Preparar la consulta
// $sql = "INSERT INTO likes (id_cliente, id_usuario) VALUES ('$idperfil', '$idusuario')";

// // Ejecutar la consulta
// if (mysqli_query($db, $sql)) {
//     echo "Nuevo registro insertado con éxito";
// } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($db);
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   if (isset($_POST['perfilId'], $_POST['usuarioId'])) {
//       var_dump($_POST);
//       $perfilId = $_POST['perfilId'];
//       $usuarioId = $_POST['usuarioId'];

//       $sql = 'INSERT INTO likes (id_cliente, id_usuario) VALUES ("'.$perfilId.'", "'.$usuarioId.'")';
//       $stmt = $db->prepare($sql);
//       $stmt->execute([$perfilId, $usuarioId]);
//       echo $stmt->errorInfo()[2];

//       if ($stmt->rowCount() > 0) {
//           echo "El like ha sido guardado correctamente.";
//       } else {
//           echo "No se ha podido guardar el like.";
//       }
//   } else {
//       echo "Error: No se han proporcionado los parámetros necesarios.";
//   }
// }
// $perfilId = $_POST['id_cliente'];
// $usuarioId = $_POST['id_usuario'];

// $query = "INSERT INTO likes (id_cliente, id_usuario) VALUES ('$perfilId', '$usuarioId')";

// $resultado = mysqli_query($db, $query);

// if (!$resultado) {
//   die("Error al guardar el like: " . mysqli_error($db));
// }


?>