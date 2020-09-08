<?php
require('util/functions.php');
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    $usernameEscaped = pg_escape_string($_POST["username"]);
    $password = $_POST["password"];

    $code = pg_escape_string($_POST["code"]);
    $shop = pg_escape_string($_POST["shop"]);
    $owner = pg_escape_string($_POST["owner"]);
    $badge = pg_escape_string($_POST["badge"]);
    $status = pg_escape_string($_POST["status"]);
    $extra = pg_escape_string($_POST["extra"]);
    
    $query = "SELECT * FROM users WHERE username='$usernameEscaped';";
    $result = pg_query($query);
    $line = pg_fetch_assoc($result);
    if (password_verify($password, $line['passwordhash'])) {
        // Using All Escaped
        $query = "INSERT INTO codes (code, shop, owner, badge, status, extra) VALUES ('$code', '$shop', '$owner', '$badge', '$status', '$extra');";
        $result = pg_query($query);
        if ($result) {
            echo 'GOOD';
        } else {
            echo 'BAD';
        }

    } else {
        echo 'BAD';
    }
} else {
    redirect('/');
}

?>