$(function(){
  $('.position-selector').on('change', function(){
    var position = $(this).val();
    var player_id = $(this).data('player_id');
    $.get("ajax.php", { action: 'position', player_id: player_id, position: position});
  });

  $('.add').click(function(){
    var player_id = $(this).data('player_id');
    var parent = this;

    $.get("ajax.php", { action: 'add', player_id: player_id}).done(function( data ) {
      $(parent).parent().html(data);
      $.get("ajax.php", { action: 'display_team'}).done(function( data ) {
        $('#team .panel-body').html(data);
      });
    });
  });

  $('#players-title').click(function (){
    $('#players').toggle();
  });

  $("#search").keyup(function() {
    var value = this.value;
    value = value.toLowerCase();

    $("#player-list").find("tr").each(function(index) {
      var id = $(this).find("td").first().text();
      id = id.toLowerCase();
      $(this).toggle(id.indexOf(value) !== -1);
    });
  });

});