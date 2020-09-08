<?php=
echo("<div>AAA</div>");
session_start();
echo("<div>BBB</div>");
$method = $_SERVER["REQUEST_METHOD"];
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
?>