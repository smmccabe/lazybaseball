<?php

include "database.inc";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="script.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <title>Lazy Baseball</title>
</head>
<body>

<div id="site-wrapper" class="container">

  <h1>Lazy Baseball</h1>

  <div id="user-wrapper" class="panel panel-default">
  <div class="panel-heading">Profile</div>
  <div class="panel-body">
<?php

$user = new user($db);
if(isset($_POST['email'])) {
  $user->create_or_load($_POST['email']);
}

if($user->load()){
  print $user->email;
  $team = new team($db, $user->uid);
}
else {
  print $user->form();
}

print '</div>';
print '</div>';
print '<div id="team" class="panel panel-default">';
print '<div class="panel-heading">Team</div>';
print '<div class="panel-body">';
if(isset($team)) {
  print $team->display();
}
print '</div>';
print '</div>';
?>

<div id="players-wrapper" class="panel panel-default">
<div id="players-title" class="panel-heading">Players List</div>
<div id="players" class="panel-body">
<input id="search" class="form-control" placeholder="Search" /><br />
<table id="player-list" class="table table-striped">
<tr><th>Name</th><th>Position</th><th>War</th></tr>

<?php
$result = $db->query("SELECT * FROM data ORDER BY position asc, war desc");
while($row = $result->fetch_assoc()){
  $player = new player($db, $row['player_id']);
  print '<tr>';
  print '<td class="name"><a href="http://www.fangraphs.com/statss.aspx?playerid=' . $row['player_id'] . '">' . $row['name'] . '</a></td>';
  print '<td class="position">' . $player->position_list() . '</td>';
  print '<td class="war">' . $row['war'] . '</td>';
  if(isset($_SESSION['uid'])){
    if(!$team->on_team($player->player_id)) {
      print '<td><a class="add" data-player_id="' . $player->player_id . '" href="#add">add</a></td>';
    }
    else{
      print '<td>on team</td>';
    }
  }
  print '</tr>';
}
?>

    </table>
  </div>
  </div>
</div>

</body>
</html>