<?php
echo("<h1>AAA</h1>");
session_start();
$user = session("username");
$method = $_SERVER["REQUEST_METHOD"];

echo($user);
echo($method);

$db = parse_url(getenv("DATABASE_URL"));
$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));


$data = $pdo->pgsqlCopyToArray('Users');
echo(var_dump($data));
?>