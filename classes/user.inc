<?php

class user {
  public $uid;
  public $email;

  function __construct($db){
    $this->db = $db;
  }

  function create_or_load($email, $password) {
    if(!$this->load($email, $password)){
      $this->create($email, $password);
    }
  }

  function create($email, $password){
    $this->email = $email;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $this->db->query("INSERT INTO user (email, password) VALUES ('$email', '$password')");
    $this->uid = $this->db->insert_id;
    $_SESSION['uid'] = $this->uid;
  }

  function load($email = null, $password = null){
    if(!isset($email)){
      if(isset($_SESSION['uid'])) {
        return $this->load_uid($_SESSION['uid']);
      }
      else{
        return FALSE;
      }
    }
    else{
      return $this->load_email($email, $password);
    }
  }

  function load_uid($uid) {
    $this->uid = $uid;
    $result = $this->db->query("SELECT email FROM user WHERE uid='$uid'");
    if($row = $result->fetch_assoc()){
      $this->email = $row['email'];
      $_SESSION['uid'] = $this->uid;
      return TRUE;
    }

    return FALSE;
  }

  function load_email($email, $password){
    $this->email = $email;
    $result = $this->db->query("SELECT uid, password FROM user WHERE email='$email'");
    if($row = $result->fetch_assoc()){
      if(password_verify($password, $row['password'])) {
        $this->uid = $row['uid'];
        $_SESSION['uid'] = $this->uid;
        return TRUE;
      }
    }

    return FALSE;
  }

  function add_player($player_id){
    if($this->uid) {
      $this->db->query("INSERT INTO team VALUES ($this->uid, $player_id)");
    }
  }

  function form() {
    $output = '<form class="form-inline" method="post">';
    $output .= '<div class="form-group">';
    $output .= '<label class="sr-only">Email</label><input name="email" id="user-email" class="form-control" type="email" placeholder="email" />';
    $output .= '<label class="sr-only">Password</label><input name="password" id="user-password" class="form-control" type="password" placeholder="password" />';
    $output .= '<button type="submit" id="user-button" class="btn btn-primary glyphicon glyphicon-log-in"></button>';
    $output .= '</div>';
    $output .= '</form>';

    return $output;
  }
}