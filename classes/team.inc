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
      $this->players[] = new player($this->db, $row['player_id']);
    }
  }

  public function add($player_id) {
    $player = new player($this->db, $player_id);
    if(!$this->_position_filled($player->position)){
      $this->db->query("INSERT INTO team VALUES($this->uid, $player->player_id)");
      return TRUE;
    }
    return FALSE;
  }

  public function on_team($player_id) {
    foreach($this->players as $player) {
      if($player->player_id == $player_id) {
        return TRUE;
      }
    }
    return FALSE;
  }

  public function display(){
    $output = '<table class="table">';
    $total = 0;

    $output .= '<th>Name</th><th>Position</th><th>WAR</th>';

    foreach($this->players as $player) {
      $output .= '<tr><td>' . $player->name . '</td><td>' . $player->position . '</td><td>' . $player->war . '</td></tr>';
      $total += $player->war;
    }
    $output .= '<tr><td class="total">TOTAL</td><td></td><td class="total">' . $total . '</td></tr>';
    $output .= '</table>';

    return $output;
  }

  private function _position_filled($position){
    $of = 0;

    foreach($this->players as $player) {
      if($player->position == $position){
        if($position == 'OF'){
          $of++;
        }
        if($position != 'OF' || $of >= 3){
          return TRUE;
        }
      }
    }

    return FALSE;
  }
}