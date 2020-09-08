<?php
require('util/functions.php');
session_start();
$user = $_SESSION["username"];
$isAdmin = $_SESSION["su"];
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];

if (!$user)
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
    $query = "SELECT * FROM codes WHERE owner='$user';";
    $codes = pg_query($query);
}
?>
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<?php
if ($method == "POST") {
    
}
?>
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View'n'Control</title>
    <link rel="icon" type="image/png" href="../ico/mustache.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="ico/mustache.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            BeardCodesApp
        </a>
            <div class="mr-auto mb-2 mb-lg-0">
            </div>
            <button class="btn btn-outline-danger">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Exit
            </button>
        </div>
    </nav>
    <div class="container">
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<?php
echo "<h2>$codeshop</h2>";
?>
<table class="table table-hover ">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Badge</th>
            <th scope="col">Status</th>
            <th scope="col">Extra</th>
        </tr>
    </thead>
    <tbody>
<?php
$i = 1;
while ($code = pg_fetch_assoc($codes)) {
    $codecode = $code["code"];
    $codeowner = $code["owner"];
    $codebadge = $code["badge"];
    $codestatus = $code["status"];
    $codeextra = $code["extra"];
    echo "
    <tr>
        <th scope=\"row\">$i</th>
        <td>$codecode</td>
        <td><span class=\"badge bg-danger\">$codebadge</span></td>
        <td>
            <div class=\"btn-group\">
                <a class=\"btn btn-sm btn-outline-succes\" disabled>Vacant</a>
                <a class=\"btn btn-sm btn-outline-warning\">Taken</a>
            </div>
        </td>
        <td><span class=\"badge bg-primary\">$codeextra</span></td>
    </tr>
    ";
    $i++;
}
?>
    </tbody>
</table>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Saved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>
<?php
pg_free_result($result);
pg_close($dbconn);
?>