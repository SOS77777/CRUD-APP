<?php
$dbName = "users_app";
$connection = new mysqli('db', 'root', 'password', $dbName);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
