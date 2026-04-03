<?php
//This is for Admin access only
session_start();
if(!isset($_SESSION['user_id'])||$_SESSION['role']!=='admin'){     // this ||,(shift+\) means OR in php
  header('Location: Login.php');
  exit;
}
//The DB connection
$conn = mysqli_connect('localhost','root','','daily_discoveries');
if(!$conn) {
    die('connection failed:' . mysqli_connect_error());
}
$error='';
$success = '';

//This hanlde the form submit
if($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $name = ($_POST['name']?? '');
    $type = $_POST['type']?? '';
    $description = ($_POST['description']?? '');
    $image_path = ($_POST['image_path']?? '');

//Validation
    if($name=== '' || $type === '' )    {
        $error = 'Name and Type are required.';
    }else {
        $sql = "INSERT INTO activities(name, type , description, image_path)
                VALUES ('$name', '$type', '$description', '$image_path')";
        if (mysqli_query($conn,$sql)) {
            header('Location: ActivitiesList.php');
            exit;
        } else {
            $error = 'Database error:' . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard-Daily Discoveries</title>
    <link rel="stylesheet" href="CSS File/Styles.css">
    <style>
        input,select,textarea,button {
            color:#4a2c0a;
        }
    </style>
</head>
<body>
<header>
     <h1>New Activitiy</h1>
    <nav class="gradient-menu">
        <a href="AdminList.php">Back to Activities</a>
        <a href="AdminDashboard.php">Admin Dashboard</a>
        <a href="Logout.php">Logout</a>
    </nav>
</header>
<main style="padding:20px; max-width:600px; margin:0 auto; color:#4a2c0a;">
    <h2>Add New Activity</h2>
    <?php if ($error !== '' ): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if($success !== '' ): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>
    <form method="post" action="ActivityAdd.php">
        <label>Activity Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label style="color:#4a2c0a;">Type:</label><br>
        <select name="type" required>
            <option value="">--Select Type--</option>
            <option value="indoor">Indoor</option>
            <option value="outdoor">Outdoor</option>
        </select><br><br>

        <label>Description:</label><br>
        <textarea name ="description" rows="4" cols="40"></textarea><br><br>

        <label>Image Path:</label><br>
        <input type="text" name="image_path" placeholder=" put an jpeg image path here" ><br><br> <!--For the place holder use when adding new image -->
        <button type="submit">Save Activity</button>
    </form>
</main>
</body>
</html>
<?php
mysqli_close($conn);
?>
