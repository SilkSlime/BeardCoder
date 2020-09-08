<?php
session_start();
if (!$user)
{
    session_destroy();
    redirect('/login.php');
    exit();
}
?>