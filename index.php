<?php

require 'includes/funciones.php';
incluirTempleate('header_externo');

?>

<section class="hero">
    <div class="contenido-hero">
        <h2 class="animate__animated animate__fadeInDown">Citas en Línea</h2>
        <button class="boton-negro" type="button" onclick="location='registro.php'"> Registrarse</button>
    </div>
    <!--.Contenido-Hero Cierre-->
</section>

<main class="contenedor">

<section class="s123">
    <h2 class="">¿Cómo Funciona?</h2>
    <h3 class="">Sigue los pasos</h3>
    <div class="s123_contenedor">
        <div class="s123_contenido">
            <div id="centrar_cuadro">
                <div class="s123_cuadro">
                    <p class="num_cuadro">1</p>
                </div>
                <h3 id="h3">Crear Perfil</h3>
                <p id="p">Elige tus intereses y preferencias, para conectarte con las personas indicadas para ti y actualiza tu ubicación en cualquier momento</p>

            </div>

            <div id="centrar_cuadro">
                <div class="s123_cuadro">
                    <p class="num_cuadro">2</p>
                </div>
                <h3 id="h3">Explorar perfiles</h3>
                <p id="p">Reacciona con me gustas o suspiros de forma ilimitada y con suerte lograras hacer una coicidencia y guarda tu historial</p>


            </div>

            <div id="centrar_cuadro">
                <div class="s123_cuadro">
                    <p class="num_cuadro">3</p>
                </div>
                <h3 class="animate__animated animate__bounceInLeft " id="h3">Chatear en línea</h3>
                <p id="p">Puedes activar el modo temporal si no quieres que se conserve el historial de tus conversaciones y mantener tu privacidad</p>
            </div>

        </div>
    </div>
</section>


<div class="conteiner">
<section class="perfil">
    <div class="perfil-contenedor">
        <div class="perfil-contenido">
            <p>Modifica tu descripción, intereses y preferencias</p>
        </div>

        <div class="perfil-imagen">
            <h1>Visualiza tu perfil</h1>
            <img src="build/img/ejemploperfil.jpg" alt="imagen-perfil">
        </div>

        <div class="perfil-ejemplo">
            <h2>Ana Linares Prada</h2>
            <p>Hola, me encanta conocer lugares nuevos y la fotografia</p>
            <button class="boton-negro" type="button"> Ver Perfil</button>

        </div>
    </div>
</section>
</div>



<section class="suspiro">
    <h1>Características Únicas</h1>
    <p>Descrube que nos hace diferentes </p>
    <div class="suspiro_contenidos">
        <!-- normal -->
        <div class=" suspiro_contenido ih-item circle effect2 top_to_bottom">
            <a id="preventD" href="#">
                <div class="img"><img src="build/img/MODO-OSCURO.png" alt="img"></div>
                <div class="info">
                    <h3>Modo Oscuro</h3>
                   
                </div>
            </a>
        </div>
        <!-- end normal -->

        <!-- normal -->
        <div class=" suspiro_contenido ih-item circle effect2  bottom_to_top">
            <a id="preventD" href="#">
                <div class="img"><img src="build/img/LogoSuspiro.svg" alt="img"></div>
                <div class="info">
                    <h3>Suspiros Ilimitados</h3>
               
                </div>
            </a>
        </div>
        <!-- end normal -->

        <!-- normal -->
        <div class=" suspiro_contenido ih-item circle effect2 top_to_bottom">
            <a id="preventD" href="#">
                <div class="img"><img src="build/img/hourglass-time-passing-pass-away-260nw-1037936920.webp" alt="img"></div>
                <div class="info">
                    <h3>Mensajes temporales</h3>
                </div>
            </a>
        </div>
        <!-- end normal -->



    </div>



</section>

</main>

<!-- Se arma como un rompecabezas el fin del HTML esta en el footer -->
<?php
incluirTempleate('footer');
?>