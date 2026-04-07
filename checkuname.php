<?php
require ('db_connect.php');
$uname = $_GET['username'];
$sql = "SELECT * FROM users WHERE username = '$uname'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0){
    echo "Username already exist, pick another one!";
}
else{
    echo "valid";
}
mysqli_close($con);
?>