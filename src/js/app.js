// Escucha cuando el documento este cargado todo HMTL CSS

// const { eventNames } = require("gulp");

document.addEventListener('DOMContentLoaded', function() {
  
    eventListeners();

    darkMode();
    
    desactivarenlaces();
    animacion();

    // btnperfil();
});

function darkMode() {
    //    Leyendo las preferencias del sistema para ver si tiene modo oscuro o claro
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);
   

    // if(prefiereDarkMode.matches) {
    //     document.body.classList.add('dark-mode');
    // } else {
    //     document.body.classList.remove('dark-mode');
    // }

    // prefiereDarkMode.addEventListener('change', function() {
    //     if(prefiereDarkMode.matches) {
    //         document.body.classList.add('dark-mode');
    //     } else {
    //         document.body.classList.remove('dark-mode');
    //     }
    // });

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

function desactivarenlaces(){
  var enlances = document.querySelectorAll("#preventD");
  enlances.forEach(element => {
    console.log(element);
     element.addEventListener("click", function(evento){
        evento.preventDefault();
     });
  });

}

/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *
 *   File:  switch-checkbox.js
 *
 *   Desc:  Switch widget using input[type=checkbox] that implements ARIA Authoring Practices
 */

'use strict';

class CheckboxSwitch {
  constructor(domNode) {
    this.switchNode = domNode;
    this.switchNode.addEventListener('focus', () => this.onFocus(event));
    this.switchNode.addEventListener('blur', () => this.onBlur(event));
  }

  onFocus(event) {
    event.currentTarget.parentNode.classList.add('focus');
  }

  onBlur(event) {
    event.currentTarget.parentNode.classList.remove('focus');
  }
}

function animacion(){
    Array.from(
        document.querySelectorAll('input[type=checkbox][role^=switch]')
      ).forEach((element) => new CheckboxSwitch(element));
}


// function btnperfil() {
//   var id = document.querySelector('#id_usuario').innerText;
//   console.log(id);
//   // window.location = 'perfilusuariodescubrir.php';
//   window.location = `perfilusuariodescubrir.php?id=${id}`;
// }

