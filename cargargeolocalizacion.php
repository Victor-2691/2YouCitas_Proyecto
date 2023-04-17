<?php
require 'includes/funciones.php';
incluirTempleate('header_interno');
// Conexion a base de datos
require 'includes/config/database.php';
$db = conectarBD();

if (isset($_SESSION['idcliente'])) {
    $sessionid = $_SESSION['idcliente'];
    $nombreusuario = $_SESSION['nombre'];
} else {
    header('location: inicio_sesion.php');
}

?>
<main>
    <div class="contenedor_geoloca">
        <p hidden class="nombre_usuario_geoloca"> <?php echo $nombreusuario ?> </p>
        <p hidden id="latitud"></p>
        <p hidden id="longitud"></p>
        <div class="contenido_geoloca">
            <h1>Obtener Geolocalicación</h1>
            <img class="iconos" src="https://img.icons8.com/fluency-systems-regular/30/null/user-location.png" />
            <p>Es necesario obtener la ubicación actual, para buscar suspiros cerca de ti</p>
        </div>
        <div id="map"></div>
        <div class="centrar_btn_geo">
            <button onclick="GuardarUbicacion()" class="boton-negro estilos_btn">
                Continuar
            </button>
          
        </div>
    </div>

</main>
<script>
    // Función para manejar el evento de carga de la página
    function onPageLoad() {
        let nombre = document.querySelector('.nombre_usuario_geoloca').textContent;
        if (navigator.geolocation) {
            // Obteniendo cordenadas
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // console.log(position);
                    let latitud = position.coords.latitude;
                    let longitud = position.coords.longitude;
                    let latidudp = document.querySelector('#latitud');
                    let longitudp = document.querySelector('#longitud');
                    latidudp.textContent = latitud;
                    longitudp.textContent = longitud;
                    // const cordenadas = {
                    //     lat: position.coords.latitude,
                    //     lng: position.coords.longitude,
                    //  };
                    // console.log(latitud);
                    // console.log(longitud);
                    var map = L.map('map').setView([latitud, -longitud], 14);
                    var marker = L.marker([latitud, longitud]).addTo(map);
                    marker.bindPopup(` <div class="letraspopup"> <b> ${nombre} </b> <br>Esta es tu ubicación</div> `).openPopup();

                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);
                },

                () => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Puedes continuar usando la aplicación sin tu ubicación actual, pero no es la mejor experiencia!',
                    })
                }
            );

        } else {
            alert('Tu navegador no dispone de la Geolocalizacion');
        }
    }
    // Asociar la función onPageLoad al evento load de window
    window.addEventListener('load', onPageLoad);
</script>

<script>
    function GuardarUbicacion() {
        let latidudp = document.querySelector('#latitud').textContent;
        let longitudp = document.querySelector('#longitud').textContent;

        console.log(longitudp);
        if (latidudp == '' || longitudp == '') {
            window.location = `descubrir.php?`;
        } else {
            var parametros = {
                "latidud": latidudp,
                "longitud": longitudp

            };

            $.ajax({
                data: parametros,
                url: 'funcionesphp/registraubicacion.php',
                type: 'POST',


                beforesend: function() {
                    $('#mostrar_mensaje').html("Mensaje antes de Enviar");
                    console("Enviando peticion...")
                },


                success: function(mensaje) {

                    if (mensaje == 1) {
                        Swal.fire(
                            'Good job!',
                            'Se registro su ubicación con éxito!',
                            'success'
                        )
                        setInterval("location.reload()", 2000);
                        window.location = `descubrir.php?`;
                    }

                    if (mensaje == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'error!',

                        })
                        setInterval("location.reload()", 2000);
                    }
                },

                Error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });

        }

    }
</script>


<!-- <script>
    function registraUbicacion() {
        let latidudp = document.querySelector('#latitud').textContent;
        let longitudp = document.querySelector('#longitud').textContent;
        console.log(longitudp);
        if (latidudp == '' || longitudp == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Puedes continuar usando la aplicación sin tu ubicación actual, pero no es la mejor experiencia!',

            })
        } else {

            Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
            )
            cargageoco();

        }
    }
</script>

<script>
    function cargageoco() {
        let latidudp = document.querySelector('#latitud').textContent;
        let longitudp = document.querySelector('#longitud').textContent;
        // Inserta la geolicalizacion en la BD
        var parametros = {
            "latidud": latitud,
            "longitud": longitud
        };
        $.ajax({
            data: parametros,
            url: 'funcionesphp/registraubicacion.php',
            type: 'POST',

            success: function(mensaje) {

                if (mensaje == 1) {
                    Swal.fire(
                        'Éxito!',
                        'Tu ubicación se registro con éxito',
                        'success'
                    )

                }

                if (mensaje == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'error!',

                    })
                    setInterval("location.reload()", 2000);
                }
            },

            Error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }

        });

    }
</script> -->






<?php
incluirTempleate('footer');
?>