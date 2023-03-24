<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    <section id="cine" class="bk p-80"> 
        <div class="container">
            <div class="cine-wrap">
                <div class="cine-wrap-bk"></div>
                <div class="cine-wrap-form">
                    <h2><span class="txt-primary">2You</span>Citas</h2>
                    <h3>Inicio Sesion</h3>
                    <form action="" method="POST" class="form 
                    form-ln-gray">
                        <label for="email">Email</label>
                        <input require type="email" id="email" name="email">
                        <label for="password">Contraseña</label>
                        <input req type="password" name="password">
                        <p class="small txt-gray"><a href="#"><span class="txt-primary">Olvide mi Contraseña</span></a></p>
                        <input class="btn" type="submit" name="iniciar_sesion" value="Iniciar Sesion">
                        <!--<button class="btn" type="button" onclick="location.href='descubrir.php'">Iniciar Sesion</button> -->
                    </form>
                    <p class="small">
                        Registrarse <a href="#"><span class="txt-primary">Aqui</span></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php 

session_start();
if (isset($_SESSION['nombredelusuario'])) {
    header('location: descubrir.php');
}


            //este iniciar_sesion es el boton de la pagina
if (isset($_POST['iniciar_sesion'])) {

    $correo = $_POST['email'];
    $pass = $_POST['password'];


    $query = mysqli_query($db,"SELECT * FROM Usuarios_Clientes_Externo WHERE correo_electronico = '".$correo."' AND contrasena = '".$pass."' ");
    $consulta = mysqli_fetch_assoc($query);

    //esta  variable es para contar las filas del query


    $nr = mysqli_num_rows($query);

 
    //validar que no hayan 2 usuarios ingresando al mismo tiempo
    if (!isset($_SESSION['nombredelusuario'])) {

        if ($nr == 1) {
            // Validar si ya lleno el perfil 0 ya esta lleno 1 esta pendiente
            if($consulta['Estado'] == 1){
                $_SESSION['nombredelusuario'] = $correo;
                header("location: formulario1.php");
            }

            else{
                $_SESSION['nombredelusuario'] = $correo;
                header("location: descubrir.php");
            }

          
        }elseif ($nr == 0) {
            echo "<script>alert('El correo no existe'); window.location = 'inicio_sesion.php' </script>";
        }
    }

}

?>