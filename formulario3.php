<?php
session_start();
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();


// if (isset($_SESSION['nombredelusuario'])) {
//     $usuarioingresado = $_SESSION['nombredelusuario'];
//     //echo "<h1>Bienvanido: $usuarioingresado </h1>";
// } else {
//     header('location: inicio_sesion.php');
// }
// $idusuario =  $_GET['id'] ?? null;
// $nombre = $_GET["nombre"] ?? null;
// $generopertenece = $_GET["genero"] ?? null;
// $descripcion = "";


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $signozodiaco = $_POST['signozodiaco'] ?? null;
//     $descripcion = $_POST['descripcion'];

//     if (!$signozodiaco) {
//         $errores[] = "Debes seleccionar un signo del zodiaco (sobre ti)";
//         echo "<script>alert('Debes seleccionar un signo'); </script>";
//     }
//     if (!$descripcion) {
//         $errores[] = "Debes seleccionar un signo del zodiaco (sobre ti)";
//         echo "<script>alert('La descripción es obligatoria'); </script>";
//     }

//     // if (strlen($descripcion) < 50) {
//     //     $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres (tu perfil)";
//     //     echo "<script>alert('La descripción es obligatoria y debe tener al menos 50 caracteres); </script>";
//     // }

//     // if (strlen($descripcion) > 300) {
//     //     $errores[] = "El maximo para la descripción es de 300 caracteres)";
//     //     echo "<script>alert('El maximo para la descripción es de 300 caracteres'); </script>";
//     // }
//     if (empty($errores)) {

//         // echo $idusuario,$nombre,$generopertenece,$descripcion; 
//         // echo $idusuario,$nombre,$generopertenece,$descripcion; 
//         // $consulta = 
//         // "UPDATE Clientes_Externos
//         // SET
//         // nombre = '$nombre',
//         // id_genero_pertenece = $generopertenece,
//         // id_genero_signozodiaco = $signozodiaco,
//         // descripcion = '$descripcion'
//         // WHERE id_cliente = $idusuario";
//         // $ejecutar = mysqli_query($db, $consulta);

      
//             // // echo "<script>alert('Se actualizo con exito'); </script>";
            // header('Location: formulario4.php');
       
     

       
//         // header("Location:perfilusuariodescubrir.php?mensaje=estaesunaprueba&mensaje2=estaotromensaje");

//         // $mensaje = $_GET['mensaje'];
//         // <?php header("Location:perfilusuariodescubrir.php?id=$idCliente"

//     }
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>

    <div class="contenedor_formulario_perfil3">
    <div class="icono_formulario1">
        <a href="formulario2.php">
        <img class="iconos25black" src="https://img.icons8.com/ios-filled/50/null/undo.png"/>
        </a>
  

    </div>
        <div class="cotenedor_barra">
            <div class="progress">
                <div class="progress-bar" style="width:75%;">
                    <span class="progress-bar-text">75%</span>
                </div>
            </div>
        </div>
            <form class="formulario_interno" method="post" action="formulario4.php">
            <label>¿A quien te gustaria cononocer?</label>
            <div class="forma-contacto">
                <?php
                $consulta = "SELECT * FROM generos_buscando";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>
                    <label class="label_opciones" for="<?php echo $opciones['nombre_genero'] ?>"><?php echo $opciones['nombre_genero'] ?></label>
                    <input class="checkgenerobuscado" name="check_list_generobuscado" type="radio" value="<?php echo $opciones['id_genero'] ?>" id="<?php echo $opciones['nombre_genero'] ?>">
                <?php endforeach ?>



            </div>


            <label id="lable_encontrar" for="signo">¿Qué te gustaria encontrar?</label>
            <select name="preferencias" id="preferencias">
                <option value="" disabled selected>-- Seleccione --</option>
                <?php
                $consulta = "SELECT * FROM categoria_preferencias where estado_categoria = 1";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>
                    <option value="<?php echo $opciones['id_preferencia'] ?>"><?php echo $opciones['nombre_categoria'] ?></option>
                <?php endforeach ?>
            </select>
           


            <div class="inpunt_boton">
            <input  type="submit" value="Siguiente" class="boton-principal">
            </div>
        </form>
   



    </div>



    <script src="build/js/bundle.min.js"></script>
</body>

</html>