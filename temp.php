<?php
require "utility/functions.php";
session_start();
$user = session("user");
//----- ----- ----- VARIABLES ----- ----- -----//
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (!in_array("ADMIN", $user_permissions)) redirect("index.php");
?>

<?php
if (in_array("ADMIN", $user_permissions)) {
    //Get all users
    $query = "SELECT * FROM `users`;";
    $result = mysqli_query($connection, $query);
    //Render table header
    $row = mysqli_fetch_assoc($result);
    echo "<table class=\"table table-striped mt-3 text-center\"><thead><tr>";
    foreach ($row as $key => $value) {
        if ($key != "phash") {
            echo "<th>$key</th>";
        }
    }
    echo "<th>Extra</th></tr></thead><tbody>";
    //Render table body
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            if ($key != "phash") {
                echo "<td>$value</td>";
            }
        }
        $user_id = $row["id"];
        echo "<td><div class=\"btn-group\" role=\"group\">";
        if (!get_user_permissions_from_db($connection, $user_id)) {
            echo  "<a class=\"btn btn-success\" href=\"admin_activate.php?user_id=$user_id\">Activate</a>";
        } else {
            echo  "<a class=\"btn btn-warning\" href=\"admin_activate.php?user_id=$user_id&deactivate=true\">Deactivate</a>";
        }
        echo "<a class=\"btn btn-danger\" href=\"admin_delete/delete_user.php?user_id=$user_id&next=admin_users.php\">Del</a>
        </div></td></tr>";
    }
    echo "</tbody><table class=\"table table-striped mt-3 text-center\">";
}
?>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>