<?php

require 'includes/funciones.php';
incluirTempleate('header_externo');

?>


<main class="contenedor seccion">
    <h1>Bienvenido</h1>

    <!-- <h2>Necesitamos saber un poco más de ti</h2> -->

    <form class="formulario">
        <fieldset>
            <legend>Datos Generales</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" required>

            <label for="apellido1">Primer Apellido</label>
            <input type="text" placeholder="Primer Apellido" id="apellido1">

            <label for="apellido2">Segundo Apellido</label>
            <input type="text" placeholder="Segundo Apellido" id="apellido2">

            <label for="telefono">Número de télefono</label>
            <input type="text" placeholder="Número de télefono" id="apellido2">


            <label for="fecha">Fecha de nacimiento</label>
            <input type="date" id="fechaNacimiento">
            <p>Mostrar mi edad</p>
            <div class="forma-contacto">
            <div class="toggle">
                <input type="checkbox">
                <label for="" class="onbtn">Si</label>
                <label for="" class="ofbtn">No</label>
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

        <fieldset>
            <legend>Sobre ti</legend>

            <select name="slider2" id="slider2" data-role="slider">
                <option value="off">Off</option>
                <option value="on">On</option>
            </select>

            <label for="opciones">Vende o Compra:</label>
            <select id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">E-mail</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligió teléfono, elija la fecha y la hora</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00">

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<!-- Se arma como un rompecabezas el fin del HTML esta en el footer -->
<?php
incluirTempleate('footer');
?>