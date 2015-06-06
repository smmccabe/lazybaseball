<?php

class player {
  private $db;
  private $player_id;
  public $name;
  public $war;

  function __construct(mysqli $db, $player_id){
    $this->player_id = $player_id;
    $this->load();
  }

  public function load(){
    $result = $this->db->query("SELECT * FROM fangraphs WHERE player_id = $this->player_id");
    if($row = $result->fetch_assoc()){
      $this->name = $row['name'];
      $this->war = $row['war'];
    }
  }
}