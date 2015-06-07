$(function(){
  $('.position-selector').on('change', function(){
    var position = $(this).val();
    var player_id = $(this).data('player_id');
    $.get("ajax.php", { action: 'position', player_id: player_id, position: position});
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

  $("#search").keyup(function() {
    var value = this.value;
    value = value.toLowerCase();

    $("table").find("tr").each(function(index) {
      var id = $(this).find("td").first().text();
      id = id.toLowerCase();
      $(this).toggle(id.indexOf(value) !== -1);
    });
  });

});