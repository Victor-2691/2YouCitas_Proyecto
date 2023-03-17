<?php
 function conectarBD() : mysqli{
    $db = mysqli_connect('138.59.135.31', 'tiusr2cp_grupo4', ')vyEXe_G.IhT', 'tiusr2cp_2youcitasbd_sitiosg4');
    $db ->set_charset("utf8");
    
    if(!$db){
        // echo "Error en la conexion";
        // En caso de error detenemos la ejecucion
        exit;
    }
  
    return $db;

 }
