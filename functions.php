<?php
function render($path, $user = NULL, $user_permissions = NULL, $content_id = NULL) {
    require "render/$path.php";
}

function alert($message, $type = "danger") {
    echo "
    <div class=\"alert alert-$type\" role=\"alert\">
        $message
    </div>
    ";
}

function print_errors($errors) {
    foreach ($errors as $e) {
        alert($e);
    }
}

function form_button($value, $type, $block = false, $outline = false, $form = "form") {
//
    $bclass = "btn";
    if ($outline) {$bclass = $bclass." btn-outline-$type";}
    else {$bclass = $bclass." btn-$type";}
    if ($block) {$bclass = $bclass." btn-block";}
    echo "<input class=\"$bclass\" type=\"submit\" value=\"$value\" form=\"$form\">";
}

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

function check_signin($connection, $username, $password) {
    $errors = array();
    $query = "SELECT * FROM `users` WHERE `username` = \"$username\";";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 1) {
        $errors[] = "No username match!";
    } else {
        $row = mysqli_fetch_assoc($result);
        $phash = $row["phash"];
        if (!password_verify($password, $phash)) {
            $errors[] = "Wrong password!";
        }
    }
    return $errors;
}

function set_user_session($connection, $username) {
    $query = "SELECT * FROM `users` WHERE `username` = \"$username\";";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $user["id"] = $row["id"];;
    $user["email"] = $row["email"];;
    $user["username"] = $row["username"];;
    $user["name"] = $row["name"];
    $user["surname"] = $row["surname"];
    $user["group"] = $row["group"];
    $_SESSION["user"] = $user;
}

?>