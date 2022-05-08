<?php

include 'connection.php';
if (isset($_POST['RN']) && isset($_POST['RD']) && isset($_POST['RS']) ) {
    $roomno = $_POST['RN'];
    $div = $_POST['RD'];
    $shift = $_POST['RS'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $message = "Enter valid Details";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
}
$q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'), "INSERT INTO rooms VALUES ('$roomno','$div','$shift')");
if ($q) {
    $message = "Classroom added.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location:addrooms.php");
} else {
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    // header("Location:index.html");

}
?>