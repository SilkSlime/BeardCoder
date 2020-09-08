<?php
require('util/functions.php');
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    echo var_dump($_POST);
}

?>