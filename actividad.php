<?php
require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

//jalar datos
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./actividad.css"> 
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="./src/js/actividad.js"></script>
	<title>Document</title>
</head>
<body>
	<div class="wrap">
		<ul class="tabs">
			<li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Me gusto</span></a></li>
			<li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text">Le gusta</span></a></li>
			<li><a href="#tab3"><span class="fa fa-briefcase"></span><span class="tab-text">Ya no me gusta</span></a></li>
			<li><a href="#tab4"><span class="fa fa-bookmark"></span><span class="tab-text">Coincidencias</span></a></li>
		</ul>
        <p id="id_usuario" hidden><?php echo $idCliente ?></p>

		<div class="secciones">
            <!-- ARTICULO ME GUSTO -->
			<article id="tab1">
                <h1>Me gusta</h1>
            <div class="card">
        <div class="content">
            <h2> <?php echo $nombre ?> <span class="edad"> <?php echo $edad ?> Años</span> </h2>

            <p>A 8 Kilómetros de distancia</p>
            <!-- <form> -->
            <div class="btn_contenedor_descubrir">
                <!-- </div>
                <div class="divbtn"> -->
                    <button class="btn_descrubrir nomegusta">
                        <!-- <img src="build/img/nomegusta.svg" alt="icono"> -->
                    </button>
                <!-- </div> -->

                <!-- <div class="divbtn"> -->
                    <button onclick="btnlike()" class="btn_descrubrir megusta">
                        <!-- <img src="build/img/megusta.svg" alt="icono"> -->
                    </button>
                <!-- </div> -->
                <!-- <div class="divbtn"> -->
                    <button class="btn_descrubrir suspiro">
                        <!-- <img src="build/img/suspiro.svg" alt="icono"> -->
                    </button>
                <!-- </div> -->

                <!-- <div class="divbtn"> -->
                    <button onclick="btnperfil()" class="btn_descrubrir perfil_descubrir">
                        <!-- <img src="build/img/perfil.svg" alt="icono"> -->
                    </button>
                <!-- </div> -->

            </div>


           <!-- </form>  -->

        </div>
        
    </div>
            <style>
                .card {
                    background-image: url("data:image/<?php echo $extension ?>;base64,<?php echo base64_encode($imagen) ?>");

                }
            </style>
			</article>
            <!-- ARTICULO LE GUSTA -->
			<article id="tab2">
            <h1>Le gusta</h1>

            </article>
            <!-- ARTICULO YA NO ME GUSTA -->
			<article id="tab3">
            <h1>Ya No Me gusta</h1>
            
            </article>
            <!-- ARTICULO COINCIDENCIAS -->
			<article id="tab4">
				<h1>Coincidencias</h1>
            </article>
		</div>
	</div>
    <script type="text/javascript">
                function btnperfil() {
                    var id = document.querySelector('#id_usuario').innerText;
                    console.log(id);
                    // window.location = 'perfilusuariodescubrir.php';
                    window.location = `perfilusuariodescubrir.php?id=${id}`;
                }
            </script>
</body>
</html>