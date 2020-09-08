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
    $query = 'SELECT * FROM shops';
    $shops = pg_query($query);
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
            <a href="/logout.php" class="btn btn-outline-danger">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Exit
            </a>
        </div>
    </nav>
    <div class="container">
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<!-- -------------------------------------------------------- -->
<?php
while ($shop = pg_fetch_assoc($shops)) {
    $shopname = $shop['name'];
    $shopdescription = $shop['description'];
    $shopimage = $shop['webimage'];
    echo "
    <div class=\"card mt-3\">
        <div class=\"card-body\">
            <h5 class=\"card-title\">$shopname</h5>
            <p class=\"card-text\">
                <img src=\"$shopimage\" class=\"rounded float-right img-thumbnail\" style=\"width: 120px; height: 120px; object-fit: cover;\">
                $shopdescription
            </p>
        </div>
        <div class=\"card-body\">
            <div class=\"row\">
                <div class=\"col text-center\">
                    <a href=\"codes.php?shop=$shopname\" class=\"btn btn-primary\">View avalible codes...</a>
                </div>
            </div>
        </div>
    </div>
    ";
    echo $shop['shop'];
}
?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Saved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <span class="badge bg-danger">Free Pizza</span>
        <span class="badge bg-danger">-40%</span>
        <span class="badge bg-danger">Additional Pepperoni</span>
        
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Badge</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>98731CEC</td>
                    <td><span class="badge bg-danger">Free Pizza</span></td>
                    <td>
                        <div class="btn-group">
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked>
                            <label class="btn btn-outline-success" for="success-outlined">Remain</label>
                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                            <label class="btn btn-outline-danger" for="danger-outlined">Sold</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>98731CEC</td>
                    <td><span class="badge bg-danger">Free Pizza</span></td>
                    <td>
                        <div class="btn-group">
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked>
                            <label class="btn btn-outline-success" for="success-outlined">Remain</label>
                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                            <label class="btn btn-outline-danger" for="danger-outlined">Sold</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>98731CEC</td>
                    <td><span class="badge bg-danger">Free Pizza</span></td>
                    <td>
                        <div class="btn-group">
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked>
                            <label class="btn btn-outline-success" for="success-outlined">Remain</label>
                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                            <label class="btn btn-outline-danger" for="danger-outlined">Sold</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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