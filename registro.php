<?php

require 'includes/funciones.php';
incluirTempleate('header_externo');

?>


<main class="contenedorform seccion">
    <h1>Regístrate</h1>

    <!-- <h2>Necesitamos saber un poco más de ti</h2> -->

    <form class="formulario">
        <fieldset class="fielsombra">
            <legend>Datos Generales</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" required>

            <label for="apellido1">Primer Apellido</label>
            <input type="text" placeholder="Primer Apellido" id="apellido1"  required>

            <label for="apellido2">Segundo Apellido</label>
            <input type="text" placeholder="Segundo Apellido" id="apellido2"  required>

            <label for="telefono">Número de télefono</label>
            <input type="number" placeholder="Número de télefono" id="telefono" min="1"   required>


            <label for="fecha">Fecha de nacimiento</label>
            <input type="date" id="fechaNacimiento"  required>
            <p>Edad visible en tu perfil</p>
            <div class="forma-contacto">
                <div class="toggle">
                    <input id="medad" type="checkbox"  required>
                    <label for="medad" class="onbtn">Si</label>
                    <label for="medad" class="ofbtn">No</label>
                </div>
            </div>

            <!-- <p>Mostrar mi edad</p>
            <div class="forma-contacto">
                <label for="fecha_si">Si</label>
                <input name="fecha" type="radio" value="Si" id="fecha_si" checked>
                <label for="fecha_no">No</label>
                <input name="fecha" type="radio" value="No" id="fecha_no">
            </div> -->
        </fieldset>

        <fieldset class="fielsombra">
            <legend>Sobre ti</legend>
           <label>Genero</label>
            <div class="forma-contacto">
                <label class="label_opciones" for="Masculino">Masculino</label>
                <input name="genero" type="radio" value="Masculino" id="Masculino">

                <label class="label_opciones" for="Femenino">Femenino</label>
                <input name="genero" type="radio" value="Femenino" id="Femenino">

                <label class="label_opciones" for="nobinario">No Binario</label>
                <input name="genero" type="radio" value="No Binario" id="nobinario">
            </div>
            <p> Genero visible en tu perfil
            <p>
            <div class="forma-contacto">
                <div class="toggle">
                    <input id="mgenero" type="checkbox">
                    <label for="mgenero" class="onbtn">Si</label>
                    <label for="mgenero" class="ofbtn">No</label>
                </div>
            </div>

            <label>Tus intereses</label>
            <p>Elige hasta 5 temas que te gusten. Te ayudará a encontrar personas que compartan tus intereses</p>
            <select multiple name="intereses">
                <optgroup label="Deportes">
                    <option value="Futbol">Futbol</option>
                    <option value="Correr">Correr</option>
                    <option value="Gimnasio">Gimnasio</option>
                    <option value="Yoga">Yoga</option>
                    <option value="Basket">Basket</option>
                </optgroup>
                <optgroup label="Creatividad">
                    <option value="Arte">Arte</option>
                    <option value="Fotografia">Fotografia</option>
                    <option value="Bailar">Bailar</option>
                    <option value="Cantar">Cantar</option>
                </optgroup>
                <optgroup label="Mascotas">
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Pezes">Pezes</option>
                    <option value="Conejo">Conejo</option>
                </optgroup>

            </select>

            <label for="signo">Signo Zodical:</label>
            <select  id="signo">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Aries">Aries</option>
                <option value="Tauro">Tauro</option>
                <option value="Géminis">Géminis</option>
                <option value="Cáncer">Cáncer</option>
                <option value="Leo">Leo</option>
                <option value="Virgo">Virgo</option>
                <option value="Libra">Libra</option>
                <option value="Escorpio">Escorpio</option>
                <option value="Sagitario">Sagitario</option>
                <option value="Capricornio">Capricornio</option>
                <option value="Acuario">Acuario</option>
                <option value="Piscis">Piscis</option>
            </select>

        </fieldset>

        <fieldset class="fielsombra">
            <legend>Que buscas</legend>
            <label>¿A quien te gustar cononocer?</label>
            <p>Puedes elegir más de una opción y cambiarla en cualquier momento</p>
            <div class="forma-contacto">
                <label class="label_opciones" for="Masculino">Masculino</label>
                <input class="checkgenerobuscado" name="genero" type="checkbox" value="Masculino" id="Masculino">

                <label class="label_opciones" for="Femenino">Femenino</label>
                <input class="checkgenerobuscado" name="genero" type="checkbox" value="Femenino" id="Femenino">

                <label class="label_opciones" for="nobinario">No Binario</label>
                <input class="checkgenerobuscado" name="genero" type="checkbox" value="No Binario" id="nobinario">
            </div>


            <label id="lable_encontrar" for="signo">¿Qué te gustaria encontrar?</label>
            <p>Puedes cambiarlo en cualquier momento</p>
            <select id="preferencias">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Relacion">Una Relación</option>
                <option value="casual">Algo Casual</option>
                <option value="amigos">Nuevos Amigos</option>
                <option value="diversion">Diversión</option>
                <option value="pensando">Lo sigo pensando</option>
                <option value="nolose">Aún no lo sé</option>
            </select>
        </fieldset>

        <fieldset class="fielsombra">
            <legend>Tu perfil</legend>
            <label for="descripcion">Agrega una breve descripción sobre ti</label>
            <p>Esta descripción sera visible para los demas usuarios</p>
            <textarea id="descripcion"></textarea>

            <label for="imagen"> Por favor agrege una foto para su perfil</label>
            <p>Esta foto sera la predertemina de su perfil, pero la puedes modificar en cualquier momento</p>
            <input id="imagen" type="file">

            <label for="correo">Correo Electrónico</label>
            <input type="email" placeholder="Correo Electrónico" id="correo" required>
            <label for="contra">Contraseña</label>
            <input pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" type="password" placeholder="Contraseña" id="contra" required>

            <label for="contraconfirma">Confirmar Contraseña</label>
            <input type="password" placeholder="Confirma Contraseña" id="contraconfirma" required>
            <div class="contiene">
            <div class="formulario_enviar">
            <label  for="mayoredad">Confirmo que soy mayor de 18 años</label>
                <input class="" name="genero" type="checkbox" value="confirmo" id="mayoredad">
            <input type="submit" value="REGISTRAR" class="boton-negro">
            </div>
            </div>
           
            
        </fieldset>

       
    </form>
</main>

<!-- Se arma como un rompecabezas el fin del HTML esta en el footer -->
<?php
incluirTempleate('footer');
?>