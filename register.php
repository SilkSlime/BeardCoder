<form action="register.php" method="POST" id="form">
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
        <div class="col-md-6 mb-3">
            <label>Repeat password</label>
            <input type="password" class="form-control" name="pass2" placeholder="Repeat password" required>
        </div>
    </div>
    <button action="submit">отправить</button>
</form>
<?php
if ($method == "POST") {
    if ($_POST["pass"]==$_POST["pass2"])
    {
        $phash = password_hash($_POST["pass"], PASSWORD_ARGON2I);
        $query = "INSERT INTO users (username, passwordHash, isAdmin) VALUES (\"$_POST["username"]\", \"$phash\", \"false\");";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    }
}
?>