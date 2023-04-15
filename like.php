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
                <li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Me Gusta</span></a></li>
                <li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text">Le gusto</span></a></li>
                <li><a href="#tab3"><span class="fa fa-group"></span><span class="tab-text">Ya no me gusta</span></a></li>
                <li><a href="#tab4"><span class="fa fa-briefcase"></span><span class="tab-text">Coincidencias</span></a></li>
                <!-- <li><a href="#tab4"><span class="fa fa-bookmark"></span><span class="tab-text">Coincidencias</span></a></li> -->
            </ul>
            <div class="secciones secciones_estilos">
                <!-- likes Enviados -->
                <article id="tab1" class="tab1_suspiros tablikes_enviados">
                    <?php
                    $consulta = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial  FROM likes S JOIN Clientes_Externos C ON S.id_usuario_recibe = C.id_cliente
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
                          
                            <img class="img_histo_perfil" src="data:<?php echo $opciones['tipo_imagen'] ?>;base64,<?php echo base64_encode($opciones['imagen']) ?>" alt="img">

                            <div class="content_suspiros">
                         
                                <h2> <?php echo $opciones['nombre']  ?> <span class="edad">
                                        <?php echo $opciones['edad'] ?> Años</span> </h2>
                                <p>Enviado: <?php echo $opciones['fecha'] ?> </p>
                                <div class="btn_contenedor_suspiro">
                                    <button  class="btn_hover btn_like_cancelar btn_suspiro_cancelar">
                                    </button>
                                    <h2 hidden class="nombre_enviado"> <?php echo $opciones['nombre']  ?>  </h2>
                                    <p hidden class="id_historial_enviados"><?php echo $opciones['id_historial']  ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </article>
                <!-- Fin likes Enviados -->

                <!-- likes Recibidos -->
                <article id="tab2" class="tab1_suspiros tab_suspiros_recibidos">
                    <?php
                    $consulta = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial,S.id_usuario_envia  FROM 
                    likes S JOIN Clientes_Externos C ON S.id_usuario_envia = C.id_cliente
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
                                <p hidden class="id_historial_recibidos"><?php echo $opciones['id_historial']  ?></p>
                                <h2 hidden class="nombre_recibidos"> <?php echo $opciones['nombre']  ?>  </h2>
                                <p hidden class="id_usuario_recibido">
                                <?php echo $opciones['id_usuario_envia']  ?>
                                </p>
                                    <!-- BTN Suspiro -->
                                    <button  class="btn_hover btn_descrubrir  megusta btn_regresarsuspiro ">
                                    </button>
                                    <!-- BTN Ver Pefil -->
                                    <button class="btn_hover btn_descrubrir perfil_descubrir btn_verperfil ">
                                    </button>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    <?php endforeach; ?>
                </article>
                <!-- Fin likes Recibidos -->


                <!-- ARTICULO YA NO ME GUSTA -->
                <article id="tab3">
                    <h1>Ya No Me gusta</h1>
                    <h1>Le gusta</h1>
                </article>
                <!-- ARTICULO COINCIDENCIAS -->
                <article id="tab4">
                        
                </article>
            </div>
        </div>


    </div>

</main>

<!-- Selecciona tarjeta para cancelar likes -->
<script>
        const tabsuspirosenviados = document.querySelector('.tablikes_enviados');
        tabsuspirosenviados.addEventListener('click', e => {
            const hero = e.target.parentElement;
            let nombre = (hero.querySelector('.nombre_enviado').textContent);
            let id = (hero.querySelector('.id_historial_enviados').textContent);
            console.log(nombre);
            console.log(id);
            if (e.target.classList.contains('btn_like_cancelar')) {
                Swal.fire({
                    title: "Confirmar",
                    text: `¿Estas seguro que deseas cancelar el like enviado ha ${nombre} ?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cancelarlike(id);
                        // window.location = `formulario.html?nombr=${nombre}&urlimg=${urlrecortado}`;
                    }
                })
            }
        });

</script>

<!-- Selecciona tarjeta para ver perfil-->
<script>
        const tabsuspirosrecibidos = document.querySelector('.tab_suspiros_recibidos');
        tabsuspirosrecibidos.addEventListener('click', e => {
            const hero = e.target.parentElement;
            let nombre = (hero.querySelector('.nombre_recibidos').textContent);
            let id_usuario_envia = (hero.querySelector('.id_usuario_recibido').textContent);
            let id_historial = (hero.querySelector('.id_historial_recibidos').textContent);
            console.log(nombre);
            console.log(id_usuario_envia);
            console.log(id_historial);
            if (e.target.classList.contains('btn_verperfil')) {
                window.location = `perfilusuariodescubrir.php?id=${id_usuario_envia}`;
            }

            if (e.target.classList.contains('btn_regresarsuspiro')) {
                Swal.fire({
                    title: "Confirmar",
                    text: `¿Estas seguro que deseas regresar el suspiro enviado ha ${nombre} ?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // cancelarlike(id);
                        // window.location = `formulario.html?nombr=${nombre}&urlimg=${urlrecortado}`;
                    }
                })
            }

           



        });

</script>






<script>
    function cancelarlike(idhistorial) {

        var id = idhistorial;

        var parametros = {
            "idhistorial": id
        };

        $.ajax({
            data: parametros,
            url: 'funcionesphp/cancelarlikes.php',
            type: 'POST',
            
            success: function(mensaje) {

                if (mensaje == 1) {
                    location.reload();

                }

                if (mensaje == 0) {
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


<?php
incluirTempleate('footer');
?>