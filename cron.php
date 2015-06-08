<?php

  include 'database.inc';

  $result = $db->query("SELECT SUM(war) as total, uid FROM team_players JOIN data USING(player_id) GROUP BY uid ORDER BY total desc");

  $rank = 1;
  $rank_increase = 1;
  $total = null;
  while($row = $result->fetch_assoc()){
    $db->query("INSERT INTO team VALUES(" . $row['uid'] . ", $rank) ON DUPLICATE KEY UPDATE rank=$rank");

    if(isset($total) && $row['total'] == $total) {
      $rank_increase++;
    }
    else{
      $rank += $rank_increase;
      $rank_increase = 0;
    }

    $total = $row['total'];
  }