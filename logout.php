<?php
if (!$user)
{
    session_destroy();
    redirect('/login.php');
    exit();
}
?>