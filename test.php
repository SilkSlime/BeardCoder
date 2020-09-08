<?php
echo("<div>AAA</div>");
session_start();
echo("<div>BBB</div>");
echo("<div>AAA</div>");
echo(var_dump($_SESSION));
?>