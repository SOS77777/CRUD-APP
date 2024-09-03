<?php
include_once("db.php");
$action = (isset($_GET["action"])) ? $_GET["action"] : false;

if ($action == "del") {
    $query = "DELETE FROM `users` WHERE " . $_GET['id'];

    $result_del = mysqli_query($connection, $query);

    if (!$result_del) {
        die("" . mysqli_error($connection));
    } else {
        $action = 'del';
        header("Location: index.php?action=$action");
        exit();
    }
}
