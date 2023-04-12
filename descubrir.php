<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

if (isset($_SESSION['idcliente'])) {
    $sessionid = $_SESSION['idcliente'];
} else {
    header('location: inicio_sesion.php');
}

// Codigo para enviar parametros por el header

// header("Location:perfilusuariodescubrir.php?mensaje=estaesunaprueba&mensaje2=estaotromensaje");

// $mensaje = $_GET['mensaje'];
// <?php header("Location:perfilusuariodescubrir.php?id=$idCliente"
?>
<?php

$consulta = "SELECT Clientes_Externos.id_genero_buscador, generos_buscando.nombre_genero FROM Clientes_Externos JOIN generos_buscando ON
Clientes_Externos.id_genero_buscador = generos_buscando.id_genero
 WHERE id_cliente = $sessionid";
$ejecutar = mysqli_query($db, $consulta);
$arregloasoc = mysqli_fetch_assoc($ejecutar);
$generobuscado = $arregloasoc['id_genero_buscador'];
$nombregenerobuscado = $arregloasoc['nombre_genero'];

switch ($generobuscado) {
        //   Busca hombres
    case 1:
        $consulta = " SELECT Clientes_Externos.nombre, Clientes_Externos.edad,
        Clientes_Externos.id_cliente, imagenes_clientes.tipo_imagen, 
        imagenes_clientes.imagen
       FROM Clientes_Externos JOIN imagenes_clientes ON Clientes_Externos.id_cliente =
       imagenes_clientes.id_cliente JOIN  Usuarios_Clientes_Externo ON Clientes_Externos.id_cliente =
         Usuarios_Clientes_Externo.id_cliente
        WHERE imagenes_clientes.imagen_perfil = 1 AND Usuarios_Clientes_Externo.Estado = 0
        AND Clientes_Externos.id_genero_pertenece = $generobuscado
        AND Usuarios_Clientes_Externo.id_cliente <> $sessionid
        ORDER BY rand() LIMIT 1";
        $ejecutar = mysqli_query($db, $consulta);

        foreach ($ejecutar as $key => $opciones) :
            $idPerfil =  $opciones['id_cliente'];
            $nombre =  $opciones['nombre'];
            $edad =  $opciones['edad'];
            $extension = $opciones['tipo_imagen'];
            $imagen =  $opciones['imagen'];
        endforeach;
        break;

        // Busca mujeres
    case 2:
        $consulta = " SELECT Clientes_Externos.nombre, Clientes_Externos.edad,
        Clientes_Externos.id_cliente, imagenes_clientes.tipo_imagen, 
        imagenes_clientes.imagen
       FROM Clientes_Externos JOIN imagenes_clientes ON Clientes_Externos.id_cliente =
       imagenes_clientes.id_cliente JOIN  Usuarios_Clientes_Externo ON Clientes_Externos.id_cliente =
         Usuarios_Clientes_Externo.id_cliente
        WHERE imagenes_clientes.imagen_perfil = 1 AND Usuarios_Clientes_Externo.Estado = 0
        AND Clientes_Externos.id_genero_pertenece = $generobuscado
        AND Usuarios_Clientes_Externo.id_cliente <> $sessionid
        ORDER BY rand() LIMIT 1";
        $ejecutar = mysqli_query($db, $consulta);
        foreach ($ejecutar as $key => $opciones) :
            $idPerfil =  $opciones['id_cliente'];
            $nombre =  $opciones['nombre'];
            $edad =  $opciones['edad'];
            $extension = $opciones['tipo_imagen'];
            $imagen =  $opciones['imagen'];
        endforeach;

        break;
        // Busca ambos
    case 3:
        $consulta = " SELECT Clientes_Externos.nombre, Clientes_Externos.edad,
        Clientes_Externos.id_cliente, imagenes_clientes.tipo_imagen, 
        imagenes_clientes.imagen
       FROM Clientes_Externos JOIN imagenes_clientes ON Clientes_Externos.id_cliente =
       imagenes_clientes.id_cliente JOIN  Usuarios_Clientes_Externo ON Clientes_Externos.id_cliente =
         Usuarios_Clientes_Externo.id_cliente
        WHERE imagenes_clientes.imagen_perfil = 1 AND Usuarios_Clientes_Externo.Estado = 0
        AND Usuarios_Clientes_Externo.id_cliente <> $sessionid
        ORDER BY rand() LIMIT 1";
        $ejecutar = mysqli_query($db, $consulta);
        foreach ($ejecutar as $key => $opciones) :
            $idPerfil =  $opciones['id_cliente'];
            $nombre =  $opciones['nombre'];
            $edad =  $opciones['edad'];
            $extension = $opciones['tipo_imagen'];
            $imagen =  $opciones['imagen'];
        endforeach;

        break;
}
?>



<main class="contenedor_descrubrir">

    <p id="id_usuario_perfil" hidden><?php echo $idPerfil ?></p>

    <div class="card">
        <div class="content">
            <h2> <?php echo $nombre ?> <span class="edad"> <?php echo $edad ?> Años</span> </h2>

            <p>A 8 Kilómetros de distancia</p>

            <div class="btn_contenedor_descubrir">
                <!-- BTN ATRAS -->
                <button class="btn_descrubrir atras">
                </button>

                <!-- BTN NO ME GUSTA -->
                <button onclick="btndescrubrir()" class="btn_descrubrir nomegusta" data-perfil-id="<?php echo $idCliente; ?>" data-usuario-id="<?php echo $sessionid; ?>">>
                </button>


                <!-- BTN Me gusta -->
                <button onclick="btndescrubrir()" class="btn_descrubrir megusta">
                </button>


                <!-- BTN Suspiro -->
                <button onclick="insertasuspiro()" class="btn_descrubrir suspiro">
                </button>


                <!-- BTN Ver Pefil -->
                <button onclick="btnperfil()" class="btn_descrubrir perfil_descubrir">
                </button>


            </div>

            <!-- Botón de "like" -->
            <!-- form para llevar a otros links los botones -->
            <!-- <form method="post" action="descubrir.php">
                <button class="like-button" data-perfil-id="<?php //echo $idCliente; 
                                                            ?>" >Like</button>
                <button class="btn_descrubir"><i class="fa-solid fa-thumbs-up"></i> </button>
                <button class="btn_descrubir"><i class="fa-sharp fa-solid fa-circle-xmark fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-thumbs-up fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-heart fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-address-card fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
            </form>  -->

        </div>
        <!-- <button class="" onclick="btnperfil()"><i class="fa-solid fa-address-card fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button> -->
    </div>
    </div>

    <div>
        <h1 hidden></h1>
    </div>

    <style>
        .card {
            background-image: url("data:image/<?php echo $extension ?>;base64,<?php echo base64_encode($imagen) ?>");

        }
    </style>

    <script type="text/javascript">
        function btnperfil() {
            var id = document.querySelector('#id_usuario_perfil').innerText;
            console.log(id);
            // window.location = 'perfilusuariodescubrir.php';
            window.location = `perfilusuariodescubrir.php?id=${id}`;
        }
    </script>

    <script type="text/javascript">
        function btndescrubrir() {
            location.reload();
        }
    </script>


    <script type="text/javascript">
        function btnlike() {
            var id = document.querySelector('#id_usuario').innerText;
            var iduser = document.querySelector('#id_userlogueado').innerText;
            console.log(id);
            console.log(iduser);
            // window.location = 'guardar_like.php';
            window.location = `guardar_like.php?id=${id}?iduser=${iduser}`;

        }
    </script>

<!-- Funcion para insertar Suspiros -->
    <script>
        function insertasuspiro() {
            var id = document.querySelector('#id_usuario_perfil').innerText;

            var parametros = {
                "idusuario": id
            };

            $.ajax({
                data: parametros,
                url: 'funcionesphp/insertarsuspiros.php',
                type: 'POST',

                beforesend: function() {
                    $('#mostrar_mensaje').html("Mensaje antes de Enviar");
                    console("Enviando peticion...")
                },

                success: function(mensaje) {

                    if (mensaje == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ya le habias dado suspiros a esta persona!',
                            showConfirmButton: false,
                        })
                        setInterval("location.reload()", 1000);

                    }

                    if (mensaje == 1) {
                        Swal.fire({
                            position: '',
                            icon: 'success',
                            title: 'Suspiro registrado',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        setInterval("location.reload()", 1000);

                    }

                    if (mensaje == 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'error!',

                        })
                        setInterval("location.reload()", 2000);
                    }
                },

                Error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
    </script>


</main>






<?php
incluirTempleate('footer');
?>