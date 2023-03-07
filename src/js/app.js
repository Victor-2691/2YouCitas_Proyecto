// Escucha cuando el documento este cargado todo HMTL CSS

document.addEventListener('DOMContentLoaded', function() {
  
    eventListeners();

    darkMode();
  
});

function darkMode() {
    //    Leyendo las preferencias del sistema para ver si tiene modo oscuro o claro
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

// CUANDO ESTE CARGADO EL DOCUMENTO CARGADO SE EJECUTA
function eventListeners() {
    // Seleccionamos la clase 
    const mobileMenu = document.querySelector('.mobile-menu');
    // Le agregamos el evento de click le asigno la funcion
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    // Seleccionamos el menu 
    const navegacion = document.querySelector('.navegacion');
// El toggle si la tiene la quita y si no la agrega
    navegacion.classList.toggle('mostrar')
}