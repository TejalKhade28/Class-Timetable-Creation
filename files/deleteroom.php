<?php

include 'connection.php';
$id = $_GET['name'];
$q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'),
    "DELETE FROM rooms WHERE room_no = '$id' ");
if ($q) {

    header("Location:addrooms.php");

} else {
    echo 'Error';
}