<?php
require('util/functions.php');
session_start();
$user = $_SESSION["username"];
$isAdmin = $_SESSION["isAdmin"];
$dbconn = pg_connect(getenv("DATABASE_URL"));
$method = $_SERVER["REQUEST_METHOD"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeardCodesApp</title>
    <link rel="icon" type="image/png" href="ico/mustache.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
<?php
    if ($user)
    {
        redirect('/');
    }
    if ($method == 'POST') {
        $username = $_POST['username'];
        $usernameEscaped = pg_escape_string($username);
        $password = $_POST['pass'];
        $query = "SELECT * FROM users WHERE username='$usernameEscaped';";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $line = pg_fetch_assoc($result);
        if (password_verify($password, $line['passwordhash'])) {
            $_SESSION['username'] = $username;
            $_SESSION['isAdmin'] = $line['isadmin'];
            redirect('/');
        } else {
            echo "<script>alert('Invalid password')</script>";
        }

    }
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="ico/mustache.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            BeardCodesApp
        </a>
        </div>
    </nav>
    <div class="container mt-5" style="max-width: 600px;">
        <form action="login.php" method="POST" id="form" style="max">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="John1337" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Rassword" required>
                </div>
            </div>
            <div class="form-row">
                    <button class="btn btn-block btn-outline-success" type="submit">Login</button>
            </div>
        </form>
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