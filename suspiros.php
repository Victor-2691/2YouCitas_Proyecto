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

?>
<main>
    <div class="contenedor_histosupiros">
        <div class="wrap">
            <ul class="tabs">
                <li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Enviados</span></a></li>
                <li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text">Recibidos</span></a></li>
                <li><a href="#tab3"><span class="fa fa-briefcase"></span><span class="tab-text">Correspondidos</span></a></li>
                <!-- <li><a href="#tab4"><span class="fa fa-bookmark"></span><span class="tab-text">Coincidencias</span></a></li> -->
            </ul>
            <div class="secciones secciones_estilos">
                <!-- Suspiros Enviados -->
                <article id="tab1" class="tab1_suspiros">
                    <?php
                    $consulta = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial  FROM suspiros S JOIN Clientes_Externos C ON S.id_usuario_recibe = C.id_cliente
                    JOIN imagenes_clientes IM ON S.id_usuario_recibe = IM.id_cliente
                    where id_usuario_envia = $sessionid and Estado = 1 AND IM.imagen_perfil = 1
                    order by S.id_historial desc";
                    $ejecutar = mysqli_query($db, $consulta);
                    if (!$ejecutar) {
                        die(mysqli_error($db));
                    }

                    ?>
                    <?php foreach ($ejecutar as $key => $opciones) :  ?>
                      
                        <div class="card_suspiros">
                        <p hidden class="id_historial_enviados"><?php echo $opciones['id_historial']  ?></p>
                            <img class="img_histo_perfil" src="data:<?php echo $opciones['tipo_imagen'] ?>;base64,<?php echo base64_encode($opciones['imagen']) ?>" alt="img">

                            <div class="content_suspiros">
                                <h2> <?php echo $opciones['nombre']  ?> <span class="edad">
                                        <?php echo $opciones['edad'] ?> Años</span> </h2>
                                <p>Enviado: <?php echo $opciones['fecha'] ?> </p>
                                <div class="btn_contenedor_suspiro">
                                    <button class="btn_hover btn_suspiro_cancelar">
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </article>
                <!-- Fin suspiros Enviados -->

                <!-- Suspiros Recibidos -->
                <article id="tab2" class="tab1_suspiros">
                    <?php
                    $consulta = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial  FROM 
                    suspiros S JOIN Clientes_Externos C ON S.id_usuario_envia = C.id_cliente
                    JOIN imagenes_clientes IM ON S.id_usuario_envia = IM.id_cliente
                    where id_usuario_recibe = $sessionid and Estado = 1 AND IM.imagen_perfil = 1
                    order by S.id_historial desc";
                    $ejecutar = mysqli_query($db, $consulta);
                    if (!$ejecutar) {
                        die(mysqli_error($db));
                    }

                    ?>
                    <?php foreach ($ejecutar as $key => $opciones) :  ?>
                        <div class="card_suspiros">
                        <p hidden class="id_historial_recibidos"><?php echo $opciones['id_historial']  ?></p>  
                        <img class="img_histo_perfil" src="data:<?php echo $opciones['tipo_imagen'] ?>;base64,<?php echo base64_encode($opciones['imagen']) ?>" alt="img">

                            <div class="content_suspiros">
                                <h2> <?php echo $opciones['nombre']  ?> <span class="edad">
                                        <?php echo $opciones['edad'] ?> Años</span> </h2>
                                <p>Recibido: <?php echo $opciones['fecha'] ?> </p>
                                <div class="btn_contenedor_suspiro">
                                    <!-- <button class="btn_hover btn_suspiro_cancelar">
                                    </button> -->
                                    <!-- BTN Suspiro -->
                                    <button onclick="insertasuspiro()" class="btn_hover btn_descrubrir suspiro ">
                                    </button>
                                    <!-- BTN Ver Pefil -->
                                    <button onclick="btnperfil()" class="btn_hover btn_descrubrir perfil_descubrir ">
                                    </button>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    <?php endforeach; ?>
                </article>
                <!-- Fin suspiros Recibidos -->


                <!-- ARTICULO YA NO ME GUSTA -->
                <article id="tab3">
                    <h1>Ya No Me gusta</h1>
                    <h1>Le gusta</h1>
                </article>
                <!-- ARTICULO COINCIDENCIAS -->
                <article id="tab4">
                    <h1>Coincidencias</h1>
                    <h1>Le gusta</h1>
                </article>
            </div>
        </div>


    </div>

</main>


<?php
incluirTempleate('footer');
?>