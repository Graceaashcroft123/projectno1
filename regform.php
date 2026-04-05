<?php
session_start();
//connecting the database
include 'db_connect.php';
//fetching values from registration form and placing it in session variables.
$_SESSION['username'] = $_GET['username'];
$_SESSION['password'] = $_GET['userPass'];
$_SESSION['email'] = $_GET['emailadd'];
//checking if the email address entered from the user already exist. If yes, error message appears and user is redirected to login webpage.
$sql1 = "SELECT email FROM users WHERE email = '".$_SESSION['email']."'";
$result1 = mysqli_query ($con, $sql1);
if (mysqli_num_rows($result1)>0){
    $_SESSION['reg_success'] = false;
    header("Location: RegistrationForm.php");
    exit();
}else{
    
     /*if such email address does not exist, we can proceed on inserting the data to the database. If an error occurs, error message is displayed and user is redirected to the registration webpage. */
    $sql2 = "INSERT INTO users( username,email,password,role) VALUES ('".$_SESSION['username']."','".$_SESSION['email']."','".$_SESSION['password']."','user')";
    if (mysqli_query($con,$sql2)){
        $_SESSION['reg_success'] = true;
    //fetching user_id from the database and storing it in a session variable.
        $sql3 = "SELECT id FROM users WHERE email = '".$_SESSION['email']."'";
        $result2 = mysqli_query($con, $sql3);
        $thisid = mysqli_fetch_assoc($result2); 
        $_SESSION['user_id'] = $thisid['id'];
        header("Location: Home.php");
        exit();
        }else{
            $_SESSION['reg_success'] = false;
            echo "Error in inserting data !" . $sql2 . "<br>" . mysqli_error($con);
            header("Location: RegistrationForm.php");
        }
    }   
mysqli_close($con);

?>