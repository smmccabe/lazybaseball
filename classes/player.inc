<?php

class player {
  private $db;
  private $player_id;
  public $name;
  public $war;
  public $position;

  function __construct(mysqli $db, $player_id){
    $this->db = $db;

    $this->player_id = $player_id;
    $this->load();
  }

  public function load(){
    $result = $this->db->query("SELECT * FROM data WHERE player_id = $this->player_id");
    if($row = $result->fetch_assoc()){
      $this->name = $row['name'];
      $this->war = $row['war'];
      $this->position = $row['position'];
    }
  }

  public function position_list() {
    if ($this->position) {
      $output = $this->position;
    }
    else {
      $output = '<select class="position" data-player_id="' . $this->player_id . '">';
      $output .= '<option>-</option>';
      $output .= $this->_position_option('SP', $this->position);
      $output .= $this->_position_option('C', $this->position);
      $output .= $this->_position_option('1B', $this->position);
      $output .= $this->_position_option('2B', $this->position);
      $output .= $this->_position_option('3B', $this->position);
      $output .= $this->_position_option('SS', $this->position);
      $output .= $this->_position_option('OF', $this->position);
      $output .= $this->_position_option('DH', $this->position);
      $output .= $this->_position_option('RP', $this->position);
      $output .= '</select>';
    }

    return $output;
  }

  private function _position_option($position, $selected) {
    $output = '<option ';
    if($position == $selected){
      $output .= 'selected ';
    }
    $output .= 'value="'. $position . '">' . $position . '</option>';

    return $output;
  }
}