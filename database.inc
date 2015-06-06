<?php

$db = new mysqli('localhost', 'lazybaseball', '', 'lazybaseball');

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

function __autoload($class_name) {
  include 'classes/' . $class_name . '.inc';
}