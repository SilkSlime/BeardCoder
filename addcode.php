<?php
require('util/functions.php');
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    $username = pg_escape_string($_POST["username"]);
    $password = $_POST["password"];

    $code = pg_escape_string($_POST["code"]);
    $shop = pg_escape_string($_POST["shop"]);
    $owner = pg_escape_string($_POST["owner"]);
    $badge = pg_escape_string($_POST["badge"]);
    $status = pg_escape_string($_POST["status"]);
    $extra = pg_escape_string($_POST["extra"]);
    
    $query = "SELECT * FROM users WHERE username='$username';";
    $result = pg_query($query);
    $line = pg_fetch_assoc($result);
    if (password_verify($password, $line['passwordhash'])) {
        $query = "INSERT INTO codes (code, shop, `owner`, badge, `status`, extra) VALUES ($code, $shop, $owner, $badge, $status, $extra);";
        $result = pg_query($query);
        echo 'Good!';

    } else {
        echo 'Wrong password/username!';
    }
} else {
    redirect('/');
}

?>