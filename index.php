<?php

include "database.inc";

?>

<html xmlns="http://www.w3.org/1999/html">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="script.js"></script>
</head>
<body>

<div id="user-wrapper">
<?php

$user = new user($db);
if(isset($_GET['email'])) {
  $user->create_or_load($_GET['email']);
}

if($user->load()){
  print $user->email;
  $team = new team($db, $user->uid);
}
else {
  print $user->form();
}

print '</div>';
print '<div id="team">';
if(isset($team)) {
  print $team->display();
}
print '</div>';

$result = $db->query("SELECT * FROM data ORDER BY position asc, war desc");
print '<table>';
while($row = $result->fetch_assoc()){
  $player = new player($db, $row['player_id']);
  print '<tr>';
  print '<td><a href="http://www.fangraphs.com/statss.aspx?playerid=' . $row['player_id'] . '">' . $row['name'] . '</a></td>';
  print '<td>' . $row['war'] . '</td>';
  print '<td>' . $player->position_list() . '</td>';
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
print '</table>';

?>

</body>
</html>