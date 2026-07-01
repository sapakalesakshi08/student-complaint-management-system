<?php
session_start();
include("db.php");

$name = $_POST['name'];
$message = $_POST['message'];
$rating = $_POST['rating'];

$sql = "INSERT INTO feedback (name, message, rating)
        VALUES ('$name', '$message', '$rating')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Your feedback has been submitted successfully!";
    header("Location: feedback.php"); // go back to form page
    exit();
} else {
    $_SESSION['error'] = "Something went wrong!";
    header("Location: feedback.php");
    exit();
}

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: .php");
    exit();
}
?>