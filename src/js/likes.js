$(document).ready(function() {
  $('.like-button').click(function(e) {
    e.preventDefault();
    var perfilId = $(this).data('perfil-id');
    $.ajax({
      type: 'POST',
      url: 'guardar_like.php',
      data: {
        perfil_id: perfilId
      },
      success: function(response) {
        console.log('Like guardado');
      },
      error: function() {
        console.log('Error al guardar el like');
      }
    });
  });
});