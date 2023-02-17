<?php
session_start();

session_unset();

echo "You logged out";
header("location: login.php");
?>