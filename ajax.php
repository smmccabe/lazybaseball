<?php

include 'database.inc';

if(isset($_GET['action'])){
  $action = $_GET['action'];
  switch($action) {
    case 'position':
        $player_id = $_GET['player_id'];
        $position = $_GET['position'];
        $db->query("UPDATE data SET position='$position' WHERE player_id=$player_id");
      break;
  }
}