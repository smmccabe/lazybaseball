<?php

include "database.inc";

?>

<html xmlns="http://www.w3.org/1999/html">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
  <script src="script.js"></script>

  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="site-wrapper">
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
print '<h2>Team</h2>';
if(isset($team)) {
  print $team->display();
}
print '</div>';
?>

  <div id="players-wrapper">
<h2 id="players-title">Players List</h2>
<div id="players">
<input class="search" placeholder="Search" />
<button class="sort" data-sort="position">Sort by Position</button><br />
<table id="player-list">
<tbody class="list">

<?php
$result = $db->query("SELECT * FROM data ORDER BY position asc, war desc");
while($row = $result->fetch_assoc()){
  $player = new player($db, $row['player_id']);
  print '<tr>';
  print '<td class="name"><a href="http://www.fangraphs.com/statss.aspx?playerid=' . $row['player_id'] . '">' . $row['name'] . '</a></td>';
  print '<td class="war">' . $row['war'] . '</td>';
  print '<td class="position">' . $player->position_list() . '</td>';
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

      </tbody>
    </table>
  </div>
  </div>
</div>

</body>
</html>