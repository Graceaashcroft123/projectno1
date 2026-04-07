<?php
require('db_connect.php');
$email = $_POST['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0){
    echo "valid";
} else {
    echo "Email not registered; please enter registered one!";
}
mysqli_close($con);
?>
