<?php

session_start();
include_once 'db.php';
$correousuarioautenticado = $_SESSION['nombredelusuario'];

$query = mysqli_query($db, "SELECT u.id_cliente, c.nombre, c.primer_apellido FROM Usuarios_Clientes_Externo u join Clientes_Externos c
on u.id_cliente = c.id_cliente WHERE u.correo_electronico = '$correousuarioautenticado'");

//esta  variable es para contar las filas del query
foreach ($query  as $key => $opciones) :
    $idcliente = $opciones['id_cliente'];
    $nombre = $opciones['nombre'];
endforeach;
$_SESSION['idcliente'] = $idcliente;
$_SESSION['nombre'] = $nombre;
$nombreusuario = $_SESSION['nombre'];
$sessionid = $_SESSION['idcliente'];




if (isset($_SESSION['nombredelusuario'])) {
    $usuarioingresado = $_SESSION['nombredelusuario'];
    // echo "<h1>Bienvanido: $usuarioingresado </h1>";
} else {
    header('location: inicio_sesion.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 YouCitas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- <script src="https://kit.fontawesome.com/474eae7f54.js" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

</head>

<body >
    <!-- Para solo mostrar el header en la pagina de inicio
So es true mostramos el header inicio que tiene la imagen -->
    <header class="header">
        <div class="contenedor contenido-header header_interno">
            <div class="barra">
                <a class="animate__animated animate__rubberBand" href="index.php">
                    <img class="imgloco" src="build/img/Logo2Youcitas_Sinfondo.svg" alt="Logotipo 2YouCitas">
                </a>

                <div hidden class="mobile-menu">

                </div>

                <div class="derecha">
                    <nav class="navegacion ">
                        <a href="descubrir.php">Descubrir</a>
                        <a href="mensajes.php">Mensajes</a>
                        <a href="like.php">Actividad</a>
                        <a href="suspiros.php">Suspiros</a>
                        <a href="perfil.php"> Perfil</a>
                        <img class="dark-mode-boton" src="build/img/dark-mode.svg">
                        <img class="dark-mode-boton day btntema" src="build/img/daymode.svg">
                        <p id="nombre_usuario"> <?php echo "$nombreusuario"; ?> </p>
                        <a href="salir.php">
                            <img class="iconos35f" src="build/img/cerrar-sesion.png" />
                        </a>

                    </nav>
                </div>

            </div> <!--.barra-->
        </div>

        <div class="header_movil">
            <div class="logo_movil">
                  <img src="build/img/2youcitasletras.svg" alt="Logotipo 2YouCitas">
                    <img class="dark-mode-boton2 btntema barramovil" src="build/img/dark-mode.svg">
                    <img class="dark-mode-boton2 day2 btntema barramovil" src="build/img/daymode.svg">
            </div>
        </div>
    </header>