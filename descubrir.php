<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

// Codigo para enviar parametros por el header

// header("Location:perfilusuariodescubrir.php?mensaje=estaesunaprueba&mensaje2=estaotromensaje");

// $mensaje = $_GET['mensaje'];
// <?php header("Location:perfilusuariodescubrir.php?id=$idCliente"

?>


<?php

$consulta = "
  SELECT  CI.id_cliente, CI.nombre, CI.primer_apellido, CI.segundo_apellido,
CI.edad,CI.descripcion, 
sz.nombre_signo, GP.nombre_genero
 FROM Clientes_Externos CI JOIN signos_zodiaco sz ON
sz.id_signo = CI.id_genero_signozodiaco JOIN generos_pertenece GP ON GP.id_genero = CI.id_genero_pertenece ORDER BY rand() LIMIT 1;";
$ejecutar = mysqli_query($db, $consulta);
foreach ($ejecutar as $key => $opciones) :
    $idCliente =  $opciones['id_cliente'];
    $nombre =  $opciones['nombre'];
    $edad =  $opciones['edad'];
endforeach;


$consulta = "select * from imagenes_clientes  where id_cliente = $idCliente and imagen_perfil =1 ";
$ejecutar = mysqli_query($db, $consulta);
foreach ($ejecutar as $key => $opciones) :
    $opciones['id_imagen'];
    $extension = $opciones['tipo_imagen'];
    $imagen =  $opciones['imagen'];
endforeach;

?>



<?php
//para los likes
if(isset($_SESSION['idcliente'])){
    $sessionid = $_SESSION['idcliente'];
    //echo "<h1>Bienvanido: $sessionid </h1>";
}

?>





<main class="contenedor_descrubrir">

    <p id="id_usuario" ><?php echo $idCliente ?></p>
    <p id="id_userlogueado" ><?php echo $sessionid ?></p>
    <h1>Descubrir</h1>


    <div class="card">
        <div class="content">
            <h2> <?php echo $nombre ?> <span class="edad"> <?php echo $edad ?> Años</span> </h2>

            <p>A 8 Kilómetros de distancia</p>
            <div class="btn_contenedor">

            <!-- form para llevar a otros links los botones -->
            <form method="post" action="guardar_like.php">
            <button class="like-button" data-perfil-id="<?php echo $idCliente ?>" data-usuario-id="<?php echo $sessionid ?>">Like</button>

                <!-- para los likes -->
                <script>
                $(document).ready(function() {
                    $('.like-button').click(function() {
                        console.log('Botón de like clickeado');
                        var perfilId = $(this).data('perfil-id');
                        var usuarioId = $(this).data('usuario-id');
                        console.log('perfilId:', perfilId);
                        console.log('usuarioId:', usuarioId);

                        $.post('guardar_like.php', { perfilId: perfilId, usuarioId: usuarioId }, function(data) {
                            console.log('Respuesta del servidor:', data);
                        });
                    });
                });
                </script>
                <button class="btn_descrubir"><i class="fa-solid fa-rotate-left fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; " ></i> </button>
                <button class="btn_descrubir"><i class="fa-sharp fa-solid fa-circle-xmark fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-thumbs-up fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-heart fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
                <button class="btn_descrubir"><i class="fa-solid fa-address-card fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
            </form> 

            </div>
            <button class="" onclick="btnlike()">like </button>
            <button class="" onclick="btnperfil()"><i class="fa-solid fa-address-card fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6; "></i> </button>
        </div>
    </div>

    <style>
        .card {
            background-image: url("data:image/<?php echo $extension ?>;base64,<?php echo base64_encode($imagen) ?>");

        }
    </style>

    <script type="text/javascript">
        function btnperfil() {
            var id = document.querySelector('#id_usuario').innerText;
            console.log(id);
            // window.location = 'perfilusuariodescubrir.php';
            window.location = `perfilusuariodescubrir.php?id=${id}`;
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


</main>






<?php
incluirTempleate('footer');
?>