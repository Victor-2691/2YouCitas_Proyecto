<?php
session_start();
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();
// $errores = [];

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $imagen = $_FILES['foto_perfil'] ?? NULL;


//     if (!$imagen['name']) {
//         $errores[] = "La imagen es obligatoria";
//         echo "<script>alert('La imagen es obligatoria') </script>";
//     }

    
//     $medida = 4000000;

//     if ($imagen['size'] > $medida) {
//         $errores[] = "El tamaño maximo para las imagenes es de 4 MB";
//         echo "<script>alert('El tamaño maximo para las imagenes es de 4 MB') </script>";
//     }



//     if (empty($errores)) {
//         echo "<script>window.location = 'descubrir.php' </script>";

//     }




// }





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>
    <div class="icono_formulario1">
        <a href="formulario3.php">
            <img class="iconos25black" src="https://img.icons8.com/ios-filled/50/null/undo.png" />
        </a>


    </div>
    <div class="contenedor_formulario_perfil4">
        <div class="cotenedor_barra">
            <div class="progress">
                <div class="progress-bar" style="width:100%;">
                    <span class="progress-bar-text">100%</span>
                </div>
            </div>
        </div>
        <form class="formulario_interno" method="post" action="descubrir.php" enctype="multipart/form-data">
        <label>
           Selecciona tus intereses
        </label>    
    
            <select multiple name="intereses[]" id="inter">
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

            <div class="foto_perfil_formu">
            <label for="imagen">Agrega una foto para tu perfil</label>
            <input name="foto_perfil" id="imagen" type="file" accept="image/jpeg, img/jpg">

            </div>

        


            <div class="inpunt_boton">
                <input type="submit" value="Finalizar" class="boton-principal">
            </div>
        </form>




    </div>
    <script type="text/javascript">
        function btnperfil() {
            // // window.location = 'perfilusuariodescubrir.php';
            // window.location = 'descubrir.php';
        }
    </script>



    <script src="build/js/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>

    <script>
        new MultiSelectTag('inter',{
            rounded: true,    
    shadow: true 
        }) // id
   
    </script>
</body>

</html>