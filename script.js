$(function(){
  var player_list = new List('players', { valueNames: [ 'name', 'war', 'position' ] });

  $('.position-selector').on('change', function(){
    alert("argh");
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
      alert(data);
    });
  });

  $('#players-title').click(function (){
    $('#players').toggle();
  });

});