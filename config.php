<?php
$hostname = "localhost";
$data_base = "dev_apps3";
$user = "root";
$password = "";

$mysqli = new mysqli($hostname, $user, $password, $data_base);

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") ";
  $mysqli->connect_error;
  return;
}

$urlweb = 'http://192.168.64.2/web-project/'; // Path: config.php
?>