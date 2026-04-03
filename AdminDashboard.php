<?php
session_start();
// Only allow access if logged in and role is admin
if(!isset($_SESSION['user_id'])||$_SESSION['role']!=='admin'){     // this ||,(shift+\) means OR in php
  header('Location: Login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard-Daily Discoveries</title>
    <link rel="stylesheet" href="CSS File/Styles.css">
</head>
<body>
    <header>
    <h1>Welcome Admin <?php echo htmlspecialchars($_SESSION['username']);?></h1> <!--htmlspecialchars is not necessary I just included it to try-->
    <nav class="gradient-menu">
    <ul>
        <li><a href="AdminDashboard.php">Dashboard</a></li>
        <li><a href="ActivitiesList.php">Manage Activities</a></li>
        <li><a href="Logout.php">Logout</a></li>
    </ul>
    </nav>
    <p>This is your admin section</P>
</body>
</html>