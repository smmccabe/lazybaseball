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
    case 'add':
      if($_SESSION['uid']){
        $user = new user($db);
        $user->load();

        $team = new team($db, $user->uid);
        if($team->add($_GET['player_id'])){
          print "on team";
        }
        else{
          print "position already filled";
        }
      }
    break;
    case 'display_team':
      $team = new team($db, $_SESSION['uid']);
      print $team->display();
  }
}