<?php
session_start();

// Optional: if you want to restrict contact form to logged-in users
//if (!isset($_SESSION['email'])) {
    // If you don't want this check, delete this whole if-block
    //die("User not logged in");
//}

// connect DB (either include or direct connect)
include 'db_connect.php';   // make sure this defines $con (mysqli_connect...)

/*
If you prefer direct connection instead of include, use:

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "daily_discoveries";

$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
*/

$fName   = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$message = $_POST['message'] ?? '';

// basic empty check (JS should already validate, but this is a safety net)
if ($fName === '' || $email === '' || $message === '') {
    echo "Please fill in all fields.";
    exit();
}

// adjust column names to match your table: email, fullName, comment
$sql = "INSERT INTO contactus (email, fullName, comment)
        VALUES ('$email', '$fName', '$message')";

if (mysqli_query($con, $sql)) {
    // optional message; usually you just redirect
    // echo "Your feedback has been recorded. We will reply to your query shortly!";
    header("Location: Home.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    exit();
}

mysqli_close($con);
?>