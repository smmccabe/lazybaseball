<?php

include "database.inc";

$result = $db->query("SELECT * FROM fangraphs");

print '<table>';
while($row = $result->fetch_assoc()){
  print '<tr><td>' . $row['name'] . '</td><td>' . $row['war'] . '</td></tr>';
}
print '</table>';