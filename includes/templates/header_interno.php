<?php

session_start();
include_once 'db.php';
$correousuarioautenticado = $_SESSION['nombredelusuario'];

$query = mysqli_query($db,"SELECT u.id_cliente, c.nombre, c.primer_apellido FROM Usuarios_Clientes_Externo u join Clientes_Externos c
on u.id_cliente = c.id_cliente WHERE u.correo_electronico = '$correousuarioautenticado'");

//esta  variable es para contar las filas del query
foreach ($query  as $key => $opciones) :
    $idcliente = $opciones['id_cliente'];  
    $nombre = $opciones['nombre'];
endforeach;

$_SESSION['idcliente'] = $idcliente;
$_SESSION['nombre'] = $nombre;
$nombreusuario = $_SESSION['nombre'];


if(isset($_SESSION['nombredelusuario'])){
    $usuarioingresado = $_SESSION['nombredelusuario'];
    //echo "<h1>Bienvanido: $usuarioingresado </h1>";
}else{
    header('location: inicio_sesion.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 YouCitas</title>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/474eae7f54.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Para solo mostrar el header en la pagina de inicio
So es true mostramos el header inicio que tiene la imagen -->
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a class="animate__animated animate__rubberBand" href="../index.php">
                    <img src="build/img/logo2youcitas150final.svg" alt="Logotipo 2YouCitas">
                </a>
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="row center-xs margin-top">
                    <div class="col-xs-6">
                        <div class="box">
                        <i class="fa-brands fa-product-hunt fa-beat "></i>
                        <i class="fa-brands fa-product-hunt fa-beat "></i>
                        <i class="fa-brands fa-product-hunt fa-beat "></i>
                        </div>

                    </div>

                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="#">Descubrir</a>
                        <a href="#">Mensajes</a>
                        <a href="#">Actividad</a>
                        <a href="#">Perfil</a>
                        <a href="#"><?php echo "$nombreusuario";?></a>
                        <br>
                        |
                        <br>
                        <form action="" method="POST">
                            <input type="submit" value="Cerrar Sesion" name="cerrar_sesion">
                        </form> 
                    </nav>
                </div>

            </div> <!--.barra-->






        </div>
    </header>
