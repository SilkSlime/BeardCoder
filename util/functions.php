<?php
function get($key) {
    return $_GET[$key];
}

function post($key){
    return $_POST[$key];
}

function session($key) {
    return $_SESSION[$key];
}

function redirect($url, $timer=0) {
    header("Refresh:$timer; url=$url");
}
?>