<?php
require('util/functions.php');
session_start();
$username = $_SESSION["username"];
$isSU = $_SESSION["su"];
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

if (!$username)
{
    redirect('/login.php');
    exit();
}
?>
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<?php
if ($method == "GET") {
    $codeshop = $_GET['shop'];
    $codeshopEscaped = pg_escape_string($codeshop);
    $usernameEscaped = pg_escape_string($username);
    $query = "SELECT * FROM codes WHERE owner='$usernameEscaped' AND shop='$codeshopEscaped' ORDER BY badge;";
    $codes = pg_query($query);
}
?>
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<?php
if ($method == "POST") {
    $codeshop = $_GET["shop"];
    $codeshopEscaped = pg_escape_string($codeshop);
    $action = $_POST["action"];
    $codecodeEscaped = pg_escape_string($_POST["code"]);
    $usernameEscaped = pg_escape_string($username);
    if ($action == "Vacant")
    {
        $query = "UPDATE codes SET status='VACANT' WHERE code='$codecodeEscaped' AND owner='$usernameEscaped' AND shop='$codeshopEscaped';";
        pg_query($query);
    }
    if ($action == "Sold")
    {
        $query = "UPDATE codes SET status='SOLD' WHERE code='$codecodeEscaped' AND owner='$usernameEscaped' AND shop='$codeshopEscaped';";
        pg_query($query);
    }
    if ($action == "Invalid")
    {
        $query = "UPDATE codes SET status='INVALID' WHERE code='$codecodeEscaped' AND owner='$usernameEscaped' AND shop='$codeshopEscaped';";
        pg_query($query);
    }
    redirect("/codes.php?shop=$codeshop");
    exit();
}
?>
<?php
$i = 1;
while ($code = pg_fetch_assoc($codes)) {
    $codecode = $code["code"];
    $codeowner = $code["owner"];
    $codebadge = $code["badge"];
    $codestatus = $code["status"];
    $codeextra = $code["extra"];
    echo "$codecode;$codestatus;$codebadge<br>";
}
?>
<?php
pg_free_result($result);
pg_close($dbconn);
?>