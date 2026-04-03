<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: Login.php');
    exit;
}

$conn = mysqli_connect('localhost','root','','daily_discoveries');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $sql = "DELETE FROM activities WHERE id=$id";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
header('Location: ActivitiesList.php');
exit;
?>
