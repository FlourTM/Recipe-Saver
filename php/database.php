<?php
// The SQL Database
$host = "localhost";
$dbname = "RecipeSaverDB";
$username = "root";
$password = "jb(@.w0/Tmk*hlXC";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;