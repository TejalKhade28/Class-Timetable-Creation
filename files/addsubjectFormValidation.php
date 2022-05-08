<?php
include 'connection.php';
if (isset($_POST['SN']) && isset($_POST['SC']) && isset($_POST['SS']) && isset($_POST['ST']) && isset($_POST['SD']) && isset($_POST['SF'])) {
    $name = $_POST['SN'];
    $code = $_POST['SC'];
    $sem = $_POST['SS'];
    $course = $_POST['ST'];
    $dept = $_POST['SD'];
    $shift = $_POST['SF'];
     $message = "nTry again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $message = "Enter valid details.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
}
$q = mysqli_query(mysqli_connect("localhost", "root", "", "tt",'3307'), "INSERT INTO subjects VALUES ('$code','$name','$course','$sem','$shift','$dept')");
if ($q) {
    $message = "Subject added.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location:addsubjects.php");
} else {
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    // header("Location:index.php");

}
?>