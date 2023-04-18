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
                <li><a href="#tab1"><span class="fa fa-home"></span><span class="tab-text">Enviados</span> </a></li>
                <li><a href="#tab2"><span class="fa fa-group"></span><span class="tab-text"> Recibidos</span></a></li>
                <li><a href="#tab3"><span class="fa fa-briefcase"></span><span class="tab-text">Correspondidos</span></a></li>
                <!-- <li><a href="#tab4"><span class="fa fa-bookmark"></span><span class="tab-text">Coincidencias</span></a></li> -->
            </ul>
            <div class="secciones secciones_estilos">
                <!-- Suspiros Enviados -->
                <article id="tab1" class="tab1_suspiros tabsuspiros_enviados">
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

                            <img class="img_histo_perfil" src="data:<?php echo $opciones['tipo_imagen'] ?>;base64,<?php echo base64_encode($opciones['imagen']) ?>" alt="img">

                            <div class="content_suspiros">

                                <h2> <?php echo $opciones['nombre']  ?> <span class="edad">
                                        <?php echo $opciones['edad'] ?> Años</span> </h2>
                                <p>Enviado: <?php echo $opciones['fecha'] ?> </p>
                                <div class="btn_contenedor_suspiro">
                                    <button class="btn_hover btn_suspiro_cancelar">
                                    </button>
                                    <h2 hidden class="nombre_enviado"> <?php echo $opciones['nombre']  ?> </h2>
                                    <p hidden class="id_historial_enviados"><?php echo $opciones['id_historial']  ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </article>
                <!-- Fin suspiros Enviados -->

                <!-- Suspiros Recibidos -->
                <article id="tab2" class="tab1_suspiros tab_suspiros_recibidos">
                    <?php
                    $consulta = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial,S.id_usuario_envia  FROM 
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
                                    <p hidden class="id_historial_recibidos"><?php echo $opciones['id_historial']  ?></p>
                                    <h2 hidden class="nombre_recibidos"> <?php echo $opciones['nombre']  ?> </h2>
                                    <p hidden class="id_usuario_recibido">
                                        <?php echo $opciones['id_usuario_envia']  ?>
                                    </p>
                                    <!-- BTN Suspiro -->
                                    <button class="btn_hover btn_descrubrir suspiro btn_regresarsuspiro ">
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
                <!-- Fin suspiros Recibidos -->


                <!-- Suspiros Correspondidos-->
                <article id="tab3" class="tab1_suspiros">
                    <?php
                    $consulta1 = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial  FROM suspiros S JOIN Clientes_Externos C ON S.id_usuario_recibe = C.id_cliente
                    JOIN imagenes_clientes IM ON S.id_usuario_recibe = IM.id_cliente
                    where id_usuario_envia = $sessionid and Estado = 4 AND IM.imagen_perfil = 1
                    order by S.id_historial desc";
                    $ejecutar1 = mysqli_query($db, $consulta1);

                    $consulta2 = "SELECT C.nombre, C.edad, S.fecha, IM.tipo_imagen, IM.imagen, S.id_historial,S.id_usuario_envia  FROM 
                    suspiros S JOIN Clientes_Externos C ON S.id_usuario_envia = C.id_cliente
                    JOIN imagenes_clientes IM ON S.id_usuario_envia = IM.id_cliente
                    where id_usuario_recibe = $sessionid and Estado = 4 AND IM.imagen_perfil = 1
                    order by S.id_historial desc";
                    $ejecutar2 = mysqli_query($db, $consulta2);
                    $arreglo1 = mysqli_fetch_all($ejecutar1, MYSQLI_ASSOC);
                    $arreglo2 = mysqli_fetch_all($ejecutar2, MYSQLI_ASSOC);
                    $arreglofinal = array_merge($arreglo1, $arreglo2);
                    ?>

                    <?php foreach ($arreglofinal as $key => $opciones) :  ?>
                        <div class="card_suspiros">
                            <p hidden class="id_historial_recibidos"><?php echo $opciones['id_historial']  ?></p>
                            <img class="img_histo_perfil" src="data:<?php echo $opciones['tipo_imagen'] ?>;base64,<?php echo base64_encode($opciones['imagen']) ?>" alt="img">

                            <div class="content_suspiros">
                                <h2> <?php echo $opciones['nombre']  ?> <span class="edad">
                                        <?php echo $opciones['edad'] ?> Años</span> </h2>
                                <p>Recibido: <?php echo $opciones['fecha'] ?> </p>
                                <div class="btn_contenedor_suspiro">
                                    <p hidden class="id_historial_recibidos"><?php echo $opciones['id_historial']  ?></p>
                                    <h2 hidden class="nombre_recibidos"> <?php echo $opciones['nombre']  ?> </h2>
                                    <p hidden class="id_usuario_recibido">
                                        <?php echo $opciones['id_usuario_envia']  ?>
                                    </p>
                                    <!-- BTN mensaje-->
                                    <button class="btn_hover perfil_mensaje ">
                                    </button>
                                
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    <?php endforeach; ?>





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

<!-- Selecciona tarjeta para cancelar suspiro -->
<script>
    const tabsuspirosenviados = document.querySelector('.tabsuspiros_enviados');
    tabsuspirosenviados.addEventListener('click', e => {
        const hero = e.target.parentElement;
        let nombre = (hero.querySelector('.nombre_enviado').textContent);
        let id = (hero.querySelector('.id_historial_enviados').textContent);
        console.log(nombre);
        console.log(id);
        if (e.target.classList.contains('btn_suspiro_cancelar')) {
            Swal.fire({
                title: "Confirmar",
                text: `¿Estas seguro que deseas cancelar el suspiro enviado ha ${nombre} ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar !'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelarsuspiro(id);
                    // window.location = `formulario.html?nombr=${nombre}&urlimg=${urlrecortado}`;
                }
            })
        }
    });
</script>

<!-- Selecciona tarjeta para ver perfil y regresar suspiro-->
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
                    var parametros = {
                        "idhistorial": id_historial
                    };
                    $.ajax({
                        data: parametros,
                        url: 'funcionesphp/suspirocorrespondido.php',
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
            })
        }





    });
</script>






<script>
    function cancelarsuspiro(idhistorial) {

        var id = idhistorial;

        var parametros = {
            "idhistorial": id
        };

        $.ajax({
            data: parametros,
            url: 'funcionesphp/cancelasuspiro.php',
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