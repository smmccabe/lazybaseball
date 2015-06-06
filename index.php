<?php

include "database.inc";

?>

<html xmlns="http://www.w3.org/1999/html">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="script.js"></script>
</head>
<body>

<?php
$result = $db->query("SELECT * FROM data ORDER BY war desc");
print '<table>';
while($row = $result->fetch_assoc()){
  $player = new player($db, $row['player_id']);
  print '<tr><td>' . $row['name'] . '</td><td>' . $row['war'] . '</td>';
  print '<td>' . $player->position_list() . '</td>';
  print '</tr>';
}
print '</table>';

?>

</body>
</html>