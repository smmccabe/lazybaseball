$(function(){
  $('.position').on('change', function(){
    var position = $(this).val();
    var player_id = $(this).data('player_id');
    $.get("ajax.php", { action: 'position', player_id: player_id, position: position});
  });

  $('#user-button').click(function(){
    var email = $('#user-email').val();
    $(this).attr( 'href', function(index, value) {
      return value + '?email=' + email;
    });
  });

  $('.add').click(function(){
    var player_id = $(this).data('player_id');

    $.get("ajax.php", { action: 'add', player_id: player_id}).done(function( data ) {
      $(this).parent().html(data);
      alert(data);
      alert($(this).parent().parent().html());
    });
  });

});