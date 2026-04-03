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

$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die('Invalid activity ID.');
}

// If form submitted, update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    $description = $_POST['description'] ?? '';
    $image_path = $_POST['image_path'] ?? '';

    if ($name === '' || $type === '') {
        $error = 'Name and Type are required.';
    } else {
        $sql = "UPDATE activities
                SET name='$name',
                    type='$type',
                    description='$description',
                    image_path='$image_path'
                WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            header('Location: ActivitiesList.php');
            exit;
        } else {
            $error = 'Database error: ' . mysqli_error($conn);
        }
    }
}

// Load current activity
$sql = "SELECT * FROM activities WHERE id=$id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die('Activity not found.');
}
$activity = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Activity - Daily Discoveries</title>
    <link rel="stylesheet" href="CSS File/Styles.css">
    <style>
        input, select, textarea, button { color:#4a2c0a; }
    </style>
</head>
<body>
<header>
    <h1>Edit Activity</h1>
    <nav class="gradient-menu">
        <a href="ActivitiesList.php">Back to Activities</a>
        <a href="AdminDashboard.php">Admin Dashboard</a>
        <a href="Logout.php">Logout</a>
    </nav>
</header>

<main style="padding:20px; max-width:600px; margin:0 auto; color:#4a2c0a; background-color:#fdf5e6;">
    <h2>Edit Activity #<?php echo htmlspecialchars($activity['id']); ?></h2>

    <?php if ($error !== ''): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="ActivityEdit.php?id=<?php echo $id; ?>">
        <label>Activity Name:</label><br>
        <input type="text" name="name" required
               value="<?php echo htmlspecialchars($activity['name']); ?>"><br><br>

        <label>Type:</label><br>
        <select name="type" required>
            <option value="">--Select Type--</option>
            <option value="indoor" <?php if ($activity['type']=='indoor') echo 'selected'; ?>>Indoor</option>
            <option value="outdoor" <?php if ($activity['type']=='outdoor') echo 'selected'; ?>>Outdoor</option>
        </select><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" cols="40"><?php
            echo htmlspecialchars($activity['description']);
        ?></textarea><br><br>

        <label>Image Path:</label><br>
        <input type="text" name="image_path"
               value="<?php echo htmlspecialchars($activity['image_path']); ?>"><br><br>

        <button type="submit">Update Activity</button>
    </form>
</main>
</body>
</html>
<?php
mysqli_close($conn);
?>
