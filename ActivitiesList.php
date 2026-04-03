<?php
//This is for Admin access only
session_start();
if(!isset($_SESSION['user_id'])||$_SESSION['role']!=='admin'){     // this ||,(shift+\) means OR in php
  header('Location: Login.php');                                  // send to login page
  exit;
}
//The DB connection
$conn = mysqli_connect('localhost','root','','daily_discoveries');
if(!$conn) {
    die('connection failed:' . mysqli_connect_error());
}
//This will get all activities
$sql = "SELECT id,name,type,description,image_path FROM activities ORDER BY id DESC";  //It will take the newest 1st
$result = mysqli_query($conn,$sql);
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
    <h1>Manage Activities</h1>
    <nav class="gradient-menu">
        <a href="AdminDashboard.php">Admin Dashboard</a>
        <a href="Home.php">Home</a>
        <a href="Logout.php">Logout</a>
    </nav>
</header>
<main style="padding:20px;">
        <h2>Activities List</h2>
        <p><a href="ActivityAdd.php"> + Add New Activity</a></p>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <!--Show table rows only if we have at least 1 activity-->
            <?php if ($result && mysqli_num_rows($result)>0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td> 
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['image_path']); ?></td>
                        <td>
                            <!--The edit list will pass the activity ID-->
                            <a href="ActivityEdit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <!--Delete link with a confirmation message-->
                            <a href="ActivityDelete.php?id=<?php echo $row['id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this activity?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- If there is no activity then this will show-->
                <tr><td colspan="6">No activities found.</td></tr>
            <?php endif; ?>
        </table>
</main>
</body>
</html>
<?php
mysqli_close($conn);
?>