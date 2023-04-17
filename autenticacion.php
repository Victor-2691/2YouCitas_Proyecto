<?php
require 'includes/config/database.php';
$db = conectarBD();

$correousuario = $_GET['correousuario'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
// Instancia de la clase
$mail = new PHPMailer(true);
$codigogeneraro = rand(1000, 9999);
//    echo "<pre>";
//     var_dump($codigogeneraro);
//     echo "<pre>";

try {
    // Configurar servidor de correo
    //Server settings
    // El debug se activo con 2 y se desactiva con 0
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ti-usr2-cp.cuc-carrera-ti.ac.cr';                     //Set the SMTP 
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '2youcitas@ti-usr2-cp.cuc-carrera-ti.ac.cr'; //username
    $mail->Password   = '#Qbn?fVC1AK%';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('2youcitas@ti-usr2-cp.cuc-carrera-ti.ac.cr', '2YouCitas');
    $mail->addAddress($correousuario, 'Victor');     //Add a recipient
    //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('logo2youcitas.jpeg', 'logo.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Doble factor seguridad';
    $mail->Body    = '

    <h1>Código de verificación</h1>
    <h2>El código es : ' . $codigogeneraro . '</h2>
    <img src="cid:logo" alt="Logotipo">
    ';
    $mail->AddEmbeddedImage('build/img/Logo_correo.png', 'logo');
    $mail->send();
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doble Factor</title>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body class="body-index">

    <div id="contenedor">
        <div id="central">
            <div id="login">
                <div class="centrar_icono">
                    <div class="titulo">
                        <img src="build/img/2yousinfondo.png">
                    </div>
                </div>
     
                <h1 class="doblefactorh1">Doble factor</h1>
                <input type="number" placeholder="Código verficación" id="codigoverficacion" required>
                <button type="button" title="Ingresar" name="Ingresar" onclick="validacodigo()">Validar</button>

                <div class="pie-form">
                    <a href="autenticacion.php">Reenviar Código</a>
                </div>
            </div>
            <div class="inferior">
                <a href="inicio_sesion.php">Volver</a>
                <p hidden id="codigogenerado"> <?php echo $codigogeneraro ?></p>
                <p hidden id="correo_usuario" ><?php echo $correousuario?> </p>
            </div>
        </div>
    </div>
    <script src="build/js/bundle.min.js"></script>
</body>

<script>
    function validacodigo() {

        //  Validar que el campo no este vacio
        let codigoentrada = document.querySelector('#codigoverficacion').value;
        let codigogenerado = document.querySelector('#codigogenerado').innerText;
        if (codigoentrada === "") {
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: 'El espacio del código no puede estar vacio!',

            })
        } else {
            // Convierte el valor a número y verifica si es un número válido
            if (isNaN(codigoentrada)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Atención',
                    text: 'El valor ingresado no es un número válido!',

                })

            } else {
                var entero1 = parseInt(codigoentrada);
                var entero2 = parseInt(codigogenerado);

                if (entero1 === entero2) {
                    let correousuario = document.querySelector('#correo_usuario').innerText;
                    var parametros = {
                        "correo": correousuario
                    };

                    $.ajax({
                        data: parametros,
                        url: 'funcionesphp/doblefactor.php',
                        type: 'POST',

                        success: function(mensaje) {
                            // alert(mensaje);
                    // Perfil incomplento
                            if (mensaje == 1) {
                            
                                window.location = 'formulario1.php'
                             
                            }

                            // Perfil Completo
                            if (mensaje == 0) {
                           
                                window.location = 'cargargeolocalizacion.php'
                            }
                        },

                        Error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: 'El código es incorrecto',

                    })
                }

                // alert("El campo contiene el número: " + codigoentrada);
                // alert("El codigo generado es: " + codigogenerado);
            }
        }


    }
</script>

</html>