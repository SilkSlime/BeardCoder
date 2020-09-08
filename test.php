<?php
echo("<div>AAA</div>");
session_start();
echo("<div>BBB</div>");
echo(var_dump($_SESSION);
echo("<div>AAA</div>");
$method = $_SERVER["REQUEST_METHOD"];
echo("<div>AAA</div>");
echo($user);
echo($method);
echo("<div>AAA</div>");
$db = parse_url(getenv("DATABASE_URL"));
$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
echo("<div>AAA</div>");

$data = $pdo->pgsqlCopyToArray('Users');
echo("<div>AAA</div>");
echo(var_dump($data));
echo("<div>AAA</div>");
?>