<?php
// echo phpinfo();
require "../config.php";
require "../functions.php";

$functions = new Functions($mysqli);
$module = isset($_GET['module']) ? $_GET['module'] : 'home';
require "../app/index.php";
?>