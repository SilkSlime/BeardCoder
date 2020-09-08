<?php
session_start();
echo(var_dump($_SESSION);
$method = $_SERVER["REQUEST_METHOD"];
?>