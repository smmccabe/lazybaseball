<?php

require_once('player.inc');

class team {
  private $db;
  private $uid;
  public $players = array();

  function __construct($db, $uid) {
    $this->db = $db;
    $this->uid = $uid;

    $this->load();
  }

  function load(){
    $result = $this->db->query("SELECT player_id FROM team WHERE uid = $this->uid");
    while($row = $result->fetch_assoc()){
      $this->player[] = new player($this->db, $row['player_id']);
    }
  }
}