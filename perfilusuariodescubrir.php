<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();


$idusario = $_GET['id'];
?>


<main class="contenedor_perfil">
    

        <div class="galeria" style="--w: 800px; --h: 700px;">

            <input type="radio" name="navigation1" id="_1" checked>
            <input type="radio" name="navigation1" id="_2">
            <input type="radio" name="navigation1" id="_3">
            <input type="radio" name="navigation1" id="_4">

            <img src="https://i0.wp.com/blog.mascotaysalud.com/wp-content/uploads/2019/05/CARA-ROTTWEILER.jpg?fit=865%2C540&ssl=1" alt="Galeria CSS 1" />
            <img src="https://www.placecage.com/c/260/200" width="260" height="200" alt="Galeria CSS 2" />
            <img src="http://placekitten.com/260/200" width="260" height="200" alt="Galeria CSS 3" />
            <img src="http://www.stevensegallery.com/260/200" width="260" height="200" alt="Galeria CSS 4" />
        </div>


        <div class="perfil_nombre_distancia">
            <h1 id="margin0">Celeste <span class="edad"> 21 years</span> </h1>
            <div class="alinear_icono">
                <img class="iconos" src="https://img.icons8.com/fluency-systems-regular/30/null/user-location.png" />
                <p>A 22 Kilometros</p>

            </div>

        </div>

        <div class="perfil_descripcion">
            <h1>Descripción</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil ipsum, eaque sapiente, aspernatur eius asperiores, exercitationem ex reiciendis iure minima nam nobis doloribus autem dolores rerum. Perspiciatis, laborum! Tempore, reiciendis?</p>
        </div>

        <h1 id="h1_sobremi">Sobre Mi</h1>
        <div class="perfil_sobre_mi">
            <div class="iconos_flex">
                <img class="iconos" src="https://img.icons8.com/fluency-systems-regular/48/null/star-crescent.png" />
                <p>Libra</p>

            </div>

            <div class="iconos_flex">
                <img class="iconos" src="https://img.icons8.com/ios/50/null/gender.png" />
                <p>Mujer</p>
            </div>



        </div>


        <div class="perfil_preferencias">
            <h1>Que busco</h1>
            <div class="alinear_icono2">

                <img class="iconos" src="https://img.icons8.com/ios-glyphs/35/null/search-client.png" />
                <p> Solo amigos</p>

            </div>

        </div>
        <h1>Que me gusta</h1>
        <div class="interereses">

             <div class="interes_individual"> <p>Musica</p> </div>
             <div class="interes_individual"> <p>Gato</p> </div>
             <div class="interes_individual"> <p>Deporte</p> </div>
             <div class="interes_individual"> <p>Basket</p> </div>
             <div class="interes_individual"> <p>Musica</p> </div>
             <div class="interes_individual"> <p>Gato</p> </div>
        
        </div>










</main>



<?php
incluirTempleate('footer');
?>