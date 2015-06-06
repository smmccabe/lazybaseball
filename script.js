$(function(){
    $('.position').on('change', function(){
      var position = $(this).val();
      var player_id = $(this).data('player_id');
      $.get("ajax.php", { action: 'position', player_id: player_id, position: position});
    });


});