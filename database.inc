<?php

$db = new mysqli('localhost', 'lazybaseball', '', 'lazybaseball');

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
