<?php
session_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- RENDER ----- ----- -----//
render("template_start");
render("navbar", $user, $user_permissions);
?>

<div class="card text-center mt-5">
    <div class="card-header"><h3>Sign In</h3></div>
    <div class="card-body">
        <?php
        if (!$user) {
            render("signin_form");
        }
        else {
            alert("You are already auth! But you can logout to sign in again...", "warning");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (!$user) {
            form_button("Sign In!", "success", true);
            if ($method == "POST") {
                $form_username = post("username");
                $form_pass = post("pass");
                $errors = check_signin($connection, $form_username, $form_pass);
                if (!$errors) {
                    set_user_session($connection, $form_username);
                    redirect("index.php", 0);
                } else {
                    print_errors($errors);
                }
            }
        }
        ?>
    </div>
</div>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>