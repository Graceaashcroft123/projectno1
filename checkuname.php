<?php
require ('db_connect.php');
$uname = $_GET['username'];
echo "Received:".$uname."<br>";
$sql = "SELECT * FROM users WHERE uname = '$uname'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0){
    echo "Username already exist, pick another one!";
}
else{
    echo "username is valid - not registered yet!";
}
mysqli_close($con);
?>