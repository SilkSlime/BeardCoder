<?php
require('util/functions.php');
session_start();
$user = $_SESSION["username"];
$isSU = $_SESSION["su"];
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

session_destroy();
redirect('/login.php');
exit();
?>