<?php

$host = "localhost";
$DBuser = "db_admin";
$DBpassword = "password";
$DBname = "history";

$conn = mysqli_connect($host, $DBuser, $DBpassword, $DBname);

if(!$conn) {
    die("DB connection failed".mysqli_connect_error());
}

?>