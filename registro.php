<?php

// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

// Arreglo de mensajes de errores

$errores = [];
$fecha_nacimiento = "";
$correo = "";
$contra = "";
$confirmacontra = "";
$confirmacion_mayoredad = "";
// Obtener fecha del servidor le pasamos el formato
// y miniscula solo year corto 22 y Y imprime completo 2022

$fecha_actual = getdate();
$fecha_actual_completa = $fecha_actual['year'] . "-" . $fecha_actual['mon'] . "-" . $fecha_actual['mday'];

// Calculamos la edad
function obtener_edad_segun_fecha($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}


// Accedemos al evento post del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST['Femenino']);
    // echo "<pre>";
    // echo "<pre>";
    // var_dump($_POST['NoBinario']);
    // echo "<pre>";

    // Asignamos variables para realizar las respectivas validaciones

    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $confirmacontra = $_POST['confirmacontra'];
    $confirmacion_mayoredad = $_POST['confirmacion_mayoredad'] ?? null;

    // Validamos imagen



    // echo "<pre>";
    // var_dump($_FILES['foto_perfil']);
    // echo "<pre>";

    // echo "<pre>";
    // var_dump($imagen);
    // echo "<pre>";
    // // exit;




    if (!$fecha_nacimiento) {
        $errores[] = "La fecha de nacimiento es obligatoria";
    } else {
        $edad = obtener_edad_segun_fecha($fecha_nacimiento);

        if ($edad < 18) {
            $errores[] = "Para poder utilizar la aplicación debes ser mayor de 18 años";
        }
    }

    if (!$correo) {

        $errores[] = "El correo es obligatorio";
    } else {
        $sql = "SELECT correo_electronico from Usuarios_Clientes_Externo where correo_electronico = '$correo'";
        $result = mysqli_query($db, $sql);
        $nr = mysqli_num_rows($result);

        if ($nr == 1) {
            $errores[] = "El correo electronico ya se encuentra registrado";
        }
    }

    if (!$confirmacontra || !$contra) {
        $errores[] = "La contraseña y su confirmación son obligatorias";
    } else {


        if ($confirmacontra !== $contra) {
            $errores[] = "La contraseña y la confirmación no coinciden";
        }
    }


    if (!$confirmacion_mayoredad) {

        $errores[] = "Debes confirmar que eres mayor de edad";
    }


    // Para insertar en la bd nuestro arreglo de errores debe estar vacio



    if (empty($errores)) {
        //  Insertamos en la BD
        $query = " INSERT INTO Clientes_Externos (fecha_nacimiento,create_time,edad)
            VALUES
            (
            '$fecha_nacimiento',
            '$fecha_actual_completa',
            $edad)";
        //   $resultado = mysqli_query($db,$query);

        if (($resultado = mysqli_query($db, $query))) {

            $idcliente = mysqli_insert_id($db);

            $query2 = " INSERT INTO Usuarios_Clientes_Externo (correo_electronico,
            id_cliente,
            fecha_registro,
            Estado,
            contrasena)
            VALUES
            ('$correo',$idcliente,
            '$fecha_actual_completa',
            1,
            '$contra')";
            if (($resultado2 = mysqli_query($db, $query2))) {
                echo "<script>alert('Se registro con exito'); window.location = 'inicio_sesion.php' </script>";
                echo "<script>
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                  )</script>";

                
              
            } else {
                die(mysqli_error($db));
            }
        } else {

            die(mysqli_error($db));
        }
    }
}


require 'includes/funciones.php';
incluirTempleate('header_externo');



?>


<main class="contenedorform seccion">



    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">

            <?php echo $error  ?>
        </div>


        </div>


    <?php endforeach; ?>

    <form class="formulario" method="POST" action="registro.php" enctype="multipart/form-data">
        <fieldset class="fielsombra">
            <legend>Datos Generales</legend>


            <label for="correo">Correo Electrónico</label>
            <input name="correo" type="email" placeholder="Correo Electrónico" id="correo" value="<?php echo $correo ?>">
            <label for="contra">Contraseña</label>
            <input name="contra" type="password" placeholder="Contraseña" id="contra">
            <label for="contraconfirma">Confirmar Contraseña</label>
            <input name="confirmacontra" type="password" placeholder="Confirma Contraseña" id="contraconfirma">

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
incluirTempleate('footer_externo');
?>