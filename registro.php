<?php

// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

// Arreglo de mensajes de errores

$errores = [];
$nombre = "";
$apellido1 = "";;
$apellido2 = "";
$telefono = "";
$fecha_nacimiento = "";
$signozodiaco = "";
$descripcion = "";
$correo = "";
$contra = "";
$confirmacontra = "";
$confirmacion_mayoredad = "";
$generobuscado =   "";
$generopertenece = "";
$intereses = "";
$preferencias = "";
// Obtener fecha del servidor le pasamos el formato
// y miniscula solo year corto 22 y Y imprime completo 2022

$fecha_actual = getdate();
$fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];




// Accedemos al evento post del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // echo "<pre>";
    // var_dump ($_POST['fecha_nacimiento']);
    // echo "<pre>";
    // echo "<pre>";
    // var_dump($_POST['Femenino']);
    // echo "<pre>";
    // echo "<pre>";
    // var_dump($_POST['NoBinario']);
    // echo "<pre>";

    // Asignamos variables para realizar las respectivas validaciones
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['primer_apellido'];
    $apellido2 = $_POST['segundo_apellido'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $signozodiaco = $_POST['signozodiaco'];
    $descripcion = $_POST['descripcion'];
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $confirmacontra = $_POST['confirmacontra'];
    $confirmacion_mayoredad = $_POST['confirmacion_mayoredad'];
    $generobuscado =    $_POST['check_list_generobuscado'];
    $generopertenece = $_POST['genero_pertenece'];
    $intereses = $_POST['intereses'];
    $preferencias = $_POST['preferencias'];
    $contador = 0;

    // Comenzamos las validaciones si los campos estan vacios
    if (!$nombre) {
        $errores[] = "El nombre es un campo obligatorio (datos generales)";
    }

    if (!$apellido1) {
        $errores[] = "El primer apellido es un campo obligatorio (datos generales)";
    }

    if (!$apellido2) {
        $errores[] = "El segundo apellido es un campo obligatorio (datos generales)";
    }

    if (!$telefono) {
        $errores[] = "El telefono es un campo obligatorio (datos generales)";
    }

    if (!$fecha_nacimiento) {
        $errores[] = "La fecha de nacimiento es obligatoria (datos generales)";
    }

    if (!$signozodiaco) {
        $errores[] = "Debes seleccionar un signo del zodiaco (sobre ti)";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres (tu perfil)";
    }

    if (strlen($descripcion) > 300) {
        $errores[] = "El maximo para la descripción es de 300 caracteres)";
    }

    if (!$correo) {
        $errores[] = "El correo es obligatorio (tu perfil)";
    }

    if (!$contra) {
        $errores[] = "La contraseña es obligatoria (tu perfil)";
    }

    if (!$confirmacontra) {
        $errores[] = "La confirmación de la contraseña es obligatoria (tu perfil)";
    }

    if (!$confirmacion_mayoredad) {
        $errores[] = "Debes confirmar que eres mayor de edad (tu perfil)";
    }

    if (!$generopertenece) {
        $errores[] = "Se debe seleccionar un genero al que perteneces (sobre ti)";
    }


    if (!$generobuscado) {
        $errores[] = "El genero buscado es obligatorio (que buscas)";
    }

    if (!$intereses) {
        $errores[] = "Debes seleccionar al menos 2 intereses (sobre ti)";
    }

    // Puedo usar un contador para saber cuantos selecciono   
    foreach ($_POST['intereses'] as $selected) {
        $contador += 1;
    }

    if ($contador > 5) {
        $errores[] = "La cantidad maxima de intereses es de 5 (sobre ti)";
    }

    if ($contador < 2) {
        $errores[] = "La cantidad minima de intereses a seleccionar es de 2 (sobre ti)";
    }

    $sql = "SELECT correo_electronico from Usuarios_Clientes_Externo where correo_electronico = '$correo'";
    $result = mysqli_query($db, $sql);
    $nr = mysqli_num_rows($result);

    if ($nr == 1) {
        $errores[] = "El correo electronico ya se encuentra registrado";
        echo "<script>alert('El correo ya se encuentra registrado') </script>";
    }









    // Controles que tienen valor por defecto por lo cual no pueden estar vacios
    if (isset($_POST["edadvisible"])) {
        $edadvisiable = 1;
    } else {
        $edadvisiable = 0;
    }

    // Validamos el control mostrar genero
    if (isset($_POST["mostrar_genero"])) {
        $generovisible = 1;
    } else {
        $generovisible = 0;
    }

    // Para insertar en la bd nuestro arreglo de errores debe estar vacio

    // Calculamos la edad
    function obtener_edad_segun_fecha($fecha_nacimiento)
    {
        $nacimiento = new DateTime($fecha_nacimiento);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }

    $edad = obtener_edad_segun_fecha($fecha_nacimiento);



    if (empty($errores)) {
        //  Insertamos en la BD
        $query = " INSERT INTO Clientes_Externos (nombre,primer_apellido,segundo_apellido,      telefono,fecha_nacimiento,create_time,id_genero_pertenece,id_genero_buscador,id_genero_signozodiaco,descripcion,edad)
            VALUES
            ('$nombre',
            '$apellido1',
            '$apellido2',
            '$telefono',
            '$fecha_nacimiento',
            '$fecha_actual_completa',
            $generopertenece,
            $generobuscado,
            $signozodiaco,
            '$descripcion',
            $edad)";

        //   $resultado = mysqli_query($db,$query);

        if (($resultado = mysqli_query($db, $query))) {

            echo "Se inserto de forma correcta cliente";
            $idcliente = mysqli_insert_id($db);

            $query2 = " INSERT INTO Usuarios_Clientes_Externo (correo_electronico,
            id_cliente,
            fecha_registro,
            Estado,
            contrasena)
            VALUES
            ('$correo',$idcliente,
            '$fecha_actual_completa',
            0,
            '$contra')";
            if (($resultado2 = mysqli_query($db, $query2))) {
                echo "Se inserto de forma correcta Usuario";
                //  Insertar intereses
                // Revisar intereses seleccionados
                foreach ($_POST['intereses'] as $selected) {
                    $query3 = " INSERT INTO clientes_externos_x_intereses (id_cliente,
           id_intereses)
            VALUES
            ($idcliente,$selected)";
            $resultadointereses =  mysqli_query($db, $query3);

                }

                if ($resultadointereses) {

                    echo "Se inserto de forma correcta intereses";
                    $query4 = " INSERT INTO clientes_externos_x_preferencias(id_cliente,
                    id_preferencia)
                     VALUES
                     ($idcliente,$preferencias)";

                    if (($resultado4 = mysqli_query($db, $query4))) {
                        echo "Se inserto de forma correcta preferencias";
                    } else {
                        die(mysqli_error($db));
                    }
                } else {
                    die(mysqli_error($db));
                }
            } else {
                die(mysqli_error($db));
            }
        } else {

            die(mysqli_error($db));
        }



        //   else{
        //     echo "Error al insertar";
        //   }



    }






    // echo "<pre>";
    // var_dump($errores);
    // echo "<pre>";


    // Para detener la ejecucion




    // Insertamos en la BD

}



// Verificar el control de mostrar edad
// ***** ISSET ******
// Determina si una variable está definida y no es NULL.
// Si una variable ha sido removida con unset(), esta ya no estará definida. isset() devolverá FALSE 
// // Validamos si el control esta activo asignamos 1 si esta inactivo asignamos 0
// if (isset($_POST["edadvisible"])) {
//     $edadvisiable = 1;
// } else {
//     $edadvisiable = 0;
// }

// // Validar que el genero al que pertenece este seleccionado al menos uno
// if (!isset($_POST['genero_pertenece'])) {
//     echo "Debe seleccionar un genero al que pertenece";
// } else {
//     $generopertenece = $_POST['genero_pertenece'];
// }

// // Validamos el control mostrar genero
// if (isset($_POST["mostrar_genero"])) {
//     $generovisible = 1;
// } else {
//     $generovisible = 0;
// }


//   Genero buscado
// if (isset($_POST['check_list_generobuscado'])) {
//     foreach ($_POST['check_list_generobuscado'] as $selected) {
//         echo "<pre>";
//         var_dump($selected);
//         echo "<pre>";
//     }
// } else {
//     echo "Debe seleccionar lo que busca";
// }


// Revisar intereses seleccionados
// $contador = 0;
// if (isset($_POST['intereses'])) {
//     // Puedo usar un contador para saber cuantos selecciono   
//     foreach ($_POST['intereses'] as $selected) {
//         echo "<pre>";
//         var_dump($selected);
//         echo "<pre>";
//         $contador += 1;
//     }
// } else {

//     echo "Debe seleccionar al menos un intereses";
// }
// if ($contador > 5) {

//     echo "El maximo a seleccionar son 5";
// }



require 'includes/funciones.php';
incluirTempleate('header_externo');

?>


<main class="contenedorform seccion">
    <h1>Regístrate</h1>

    <!-- <h2>Necesitamos saber un poco más de ti</h2> -->

    <!-- Mostrando arreglo de errores validaciones -->

    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">

            <?php echo $error  ?>
        </div>


    <?php endforeach; ?>

    <form class="formulario" method="POST" action="registro.php">
        <fieldset class="fielsombra">
            <legend>Datos Generales</legend>

            <label for="nombre">Nombre</label>
            <input maxlength="30" require name="nombre" type="text" placeholder="Tu Nombre" id="nombre" value="<?php echo $nombre ?>">

            <label for="apellido1">Primer Apellido</label>
            <input maxlength="45" name="primer_apellido" type="text" placeholder="Primer Apellido" id="apellido1" value="<?php echo $apellido1 ?>">

            <label for="apellido2">Segundo Apellido</label>
            <input maxlength="45" name="segundo_apellido" type="text" placeholder="Segundo Apellido" id="apellido2" value="<?php echo $apellido2 ?>">

            <label for="telefono">Número de télefono</label>
            <input name="telefono" type="number" placeholder="Número de télefono" id="telefono" min="1" value="<?php echo $telefono ?>">


            <label for="fecha">Fecha de nacimiento</label>
            <input name="fecha_nacimiento" type="date" id="fechaNacimiento" value="<?php echo $fecha_nacimiento ?>">
            <p>Edad visible en tu perfil</p>
            <div class="forma-contacto">
                <div class="toggle">
                    <input checked id="medad" type="checkbox" name="edadvisible">
                    <!-- <input type="hidden" name="edadvisible" value="4" /> -->
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
                <?php
                $consulta = "SELECT * FROM generos_pertenece";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>

                    <label class="label_opciones" for="<?php echo $opciones['nombre_genero'] ?>"><?php echo $opciones['nombre_genero'] ?></label>
                    <input name="genero_pertenece" type="radio" value="<?php echo $opciones['id_genero'] ?>" id="<?php echo $opciones['nombre_genero'] ?>">

                <?php endforeach ?>
            </div>


            <p> Genero visible en tu perfil
            <p>
            <div class="forma-contacto">
                <div class="toggle">
                    <input checked name="mostrar_genero" id="mgenero" type="checkbox">
                    <label for="mgenero" class="onbtn">Si</label>
                    <label for="mgenero" class="ofbtn">No</label>
                </div>
            </div>

            <label>Tus intereses</label>
            <p>Elige hasta 5 temas que te gusten. Te ayudará a encontrar personas que compartan tus intereses</p>
            <select multiple name="intereses[]">
                <?php
                $consulta = "SELECT distinct i.id_categoria, c.nombre  FROM intereses i, categoria_intereses c where
                i.id_categoria = c.id_categoria and i.estado = 1";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));
                //esta  variable es para contar las filas del query
                $nr = mysqli_num_rows($ejecutar);
                // echo "La cantidad de filas es de " . $nr;
                $idcategorias = [];
                $nombrecategoria = [];

                foreach ($ejecutar as $key => $opciones) :
                    array_push($idcategorias, $opciones['id_categoria']);
                    array_push($nombrecategoria, $opciones['nombre']);
                endforeach;

                ?>

                <?php for ($i = 0; $i < count($idcategorias); $i++) :
                    $intereses_categoria = mysqli_query($db, "SELECT i.nombre as interes, c.nombre as categoria, i.id_interes as id FROM intereses i,categoria_intereses c WHERE i.id_categoria = c.id_categoria and i.id_categoria = $idcategorias[$i]") or die(mysqli_error($db)); ?>


                    <optgroup label="<?php echo $nombrecategoria[$i] ?>">

                        <?php foreach ($intereses_categoria  as $key => $opciones) : ?>
                            <option value="<?php echo $opciones['id'] ?>"><?php echo $opciones['interes'] ?></option>
                    </optgroup>
                <?php endforeach ?>
            <?php endfor; ?>
            </select>



            <label for="signo">Signo Zodical:</label>
            <select name="signozodiaco" id="signo">
                <option value="" disabled selected>-- Seleccione --</option>
                <?php
                $db = conectarBD();
                $consulta = "SELECT * FROM signos_zodiaco";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>

                    <option value="<?php echo $opciones['id_signo'] ?>"><?php echo $opciones['nombre_signo'] ?> </option>
                <?php endforeach ?>
            </select>

        </fieldset>

        <fieldset class="fielsombra">
            <legend>Que buscas</legend>
            <label>¿A quien te gustaria cononocer?</label>
            <p>Puedes elegir más de una opción y cambiarla en cualquier momento</p>
            <div class="forma-contacto">
                <?php
                $consulta = "SELECT * FROM generos_buscando";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>
                    <label class="label_opciones" for="<?php echo $opciones['nombre_genero'] ?>"><?php echo $opciones['nombre_genero'] ?></label>
                    <input class="checkgenerobuscado" name="check_list_generobuscado" type="radio" value="<?php echo $opciones['id_genero'] ?>" id="<?php echo $opciones['nombre_genero'] ?>">
                <?php endforeach ?>



            </div>


            <label id="lable_encontrar" for="signo">¿Qué te gustaria encontrar?</label>
            <p>Puedes cambiarlo en cualquier momento</p>
            <select name="preferencias" id="preferencias">
                <option value="" disabled selected>-- Seleccione --</option>
                <?php
                $consulta = "SELECT * FROM categoria_preferencias where estado_categoria = 1";
                $ejecutar = mysqli_query($db, $consulta) or die(mysqli_error($db));

                ?>
                <?php foreach ($ejecutar as $key => $opciones) : ?>
                    <option value="<?php echo $opciones['id_preferencia'] ?>"><?php echo $opciones['nombre_categoria'] ?></option>
                <?php endforeach ?>
            </select>
        </fieldset>

        <fieldset class="fielsombra">
            <legend>Tu perfil</legend>
            <label for="descripcion">Agrega una breve descripción sobre ti</label>
            <p>Esta descripción sera visible para los demas usuarios</p>
            <textarea maxlength="300" name="descripcion" id="descripcion"><?php echo $descripcion ?></textarea>

            <label for="imagen"> Por favor agrege una foto para su perfil</label>
            <p>Esta foto sera la predertemina de su perfil, pero la puedes modificar en cualquier momento</p>
            <input name="foto_perfil" id="imagen" type="file">

            <label for="correo">Correo Electrónico</label>
            <input name="correo" type="email" placeholder="Correo Electrónico" id="correo">
            <label for="contra">Contraseña</label>
            <input name="contra" type="password" placeholder="Contraseña" id="contra">
            <label for="contraconfirma">Confirmar Contraseña</label>
            <input name="confirmacontra" type="password" placeholder="Confirma Contraseña" id="contraconfirma">
            <div class="contiene">
                <div class="formulario_enviar">
                    <label for="mayoredad">Confirmo que soy mayor de 18 años</label>
                    <input class="" name="confirmacion_mayoredad" type="checkbox" value="confirmo" id="mayoredad">
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