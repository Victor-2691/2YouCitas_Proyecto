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

// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

/*!
 * Copyright 2013 Twitter, Inc.
 *
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see http://creativecommons.org/licenses/by/3.0/.
 */


!function ($) {

    $(function(){
  
      // IE10 viewport hack for Surface/desktop Windows 8 bug
      //
      // See Getting Started docs for more information
      if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(
          document.createTextNode(
            "@-ms-viewport{width:auto!important}"
          )
        );
        document.getElementsByTagName("head")[0].
          appendChild(msViewportStyle);
      }
  
  
      var $window = $(window)
      var $body   = $(document.body)
  
      var navHeight = $('.navbar').outerHeight(true) + 10
  
      $body.scrollspy({
        target: '.bs-sidebar',
        offset: navHeight
      })
  
      $window.on('load', function () {
        $body.scrollspy('refresh')
      })
  
      $('.bs-docs-container [href=#]').click(function (e) {
        e.preventDefault()
      })
  
      // back to top
      setTimeout(function () {
        var $sideBar = $('.bs-sidebar')
  
        $sideBar.affix({
          offset: {
            top: function () {
              var offsetTop      = $sideBar.offset().top
              var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
              var navOuterHeight = $('.bs-docs-nav').height()
  
              return (this.top = offsetTop - navOuterHeight - sideBarMargin)
            }
          , bottom: function () {
              return (this.bottom = $('.bs-footer').outerHeight(true))
            }
          }
        })
      }, 100)
  
      setTimeout(function () {
        $('.bs-top').affix()
      }, 100)
  
      // tooltip demo
      $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
      })
  
      $('.tooltip-test').tooltip()
      $('.popover-test').popover()
  
      $('.bs-docs-navbar').tooltip({
        selector: "a[data-toggle=tooltip]",
        container: ".bs-docs-navbar .nav"
      })
  
      // popover demo
      $("[data-toggle=popover]")
        .popover()
  
      // button state demo
      $('#fat-btn')
        .click(function () {
          var btn = $(this)
          btn.button('loading')
          setTimeout(function () {
            btn.button('reset')
          }, 3000)
        })
  })
  
  }(jQuery)
  