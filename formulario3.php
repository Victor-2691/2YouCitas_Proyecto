<?php
session_start();
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

$errores = [];


if (isset($_SESSION['idcliente'])) {
    $sessionid = $_SESSION['idcliente'];
} else {
    header('location: inicio_sesion.php');
}

// Accedemos al evento post del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST['Femenino']);
    // echo "<pre>";
    // echo "<pre>";
    // var_dump($_POST['NoBinario']);
    // echo "<pre>";

    $generobuscado =    $_POST['check_list_generobuscado'] ?? null;
    $preferencias = $_POST['preferencias'] ?? null;

    if (!$generobuscado) {
        $errores[] = "El genero buscado es obligatorio (que buscas)";
        echo "<script>alert('El genero buscado es obligatorio '); </script>";
    }

    if (!$preferencias) {
        $errores[] = "El genero buscado es obligatorio (que buscas)";
        echo "<script>alert('Debes seleccionar que te gustaria encontrar'); </script>";
    }


    if (empty($errores)) {
        $consulta = "UPDATE Clientes_Externos
        SET
        id_genero_buscador = $generobuscado
        WHERE id_cliente = $sessionid";
        $ejecutar = mysqli_query($db, $consulta);
        if ($ejecutar) {

            // Validamos si las preferencias es nueva o una actualizacion 
            $consulta = "Select * from clientes_externos_x_preferencias where id_cliente = $sessionid";
            $ejecutar = mysqli_query($db, $consulta);
            $contador = mysqli_num_rows($ejecutar);

            if ($contador > 0) {
                // Update 
                $consulta2 = "UPDATE clientes_externos_x_preferencias
                SET
                id_preferencia = $preferencias
                WHERE id_cliente = $sessionid";
                $ejecutar2 = mysqli_query($db, $consulta2);

                if ($ejecutar2) {
                    echo "<script>window.location = 'formulario4.php' </script>";
                } else {
                    die(mysqli_error($db));
                }
            } else {
                // Insert
                $query4 = " INSERT INTO clientes_externos_x_preferencias(id_cliente,
                id_preferencia)
                 VALUES
                 ($sessionid,$preferencias)";
                $ejecutar3 = mysqli_query($db,  $query4);
                if ($ejecutar3) {
                    echo "<script>window.location = 'formulario4.php' </script>";
                } else {
                    die(mysqli_error($db));
                }
            }
        } else {
            die(mysqli_error($db));
        }
    }
}

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
                <img class="iconos25black" src="https://img.icons8.com/ios-filled/50/null/undo.png" />
            </a>


        </div>
        <div class="cotenedor_barra">
            <div class="progress">
                <div class="progress-bar" style="width:75%;">
                    <span class="progress-bar-text">75%</span>
                </div>
            </div>
        </div>
        <form class="formulario_interno" method="post" action="formulario3.php">
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
                <input type="submit" value="Siguiente" class="boton-principal">
            </div>
        </form>




    </div>



    <script src="build/js/bundle.min.js"></script>
</body>

</html>