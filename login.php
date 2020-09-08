<?php
require('functions.php');
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
    <title>View'n'Control</title>
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
        $phash = password_hash($_POST["pass"], PASSWORD_ARGON2I);
        $query = "SELECT * FROM users WHERE username='$username';";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $line = pg_fetch_assoc($result);
        echo $line;
        if ($phash == $line['passwordhash']) {
            $_SESSION['username'] = $username;
            $_SESSION['isAdmin'] = $line['isadmin'];
            redirect('/');
        }

    }
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="./mustache.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            BeardCoderApp
        </a>
            <div class="mr-auto mb-2 mb-lg-0">
            </div>
            <button class="btn btn-outline-success">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Save
            </button>
        </div>
    </nav>
    <div class="container">
        <form action="login.php" method="POST" id="form">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="John1337" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Rassword" required>
                </div>
            </div>
            <button class="btn btn-block btn-outline-seccess" type="submit">Login</button>
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