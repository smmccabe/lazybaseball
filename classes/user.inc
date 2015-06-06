<?php

class user {
  private $uid;
  public $email;

  function __construct($db){
    $this->db = $db;
  }

  function create($email){
    $this->email = $email;
    $this->db->query("INSERT INTO user (email) VALUES ('$email')");
  }

  function add_player($player_id){
    if($this->uid) {
      $this->db->query("INSERT INTO team VALUES ($this->uid, $player_id)");
    }
  }
}