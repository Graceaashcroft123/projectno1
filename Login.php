<?php
session_start();
$error = '';                  //variable store error message when empty it means no error

// check if the form was submitted using POST Method
// NOTE triple equal sign (=), checks the value and the datatype
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $username =($_POST['username']);
    $password=($_POST['password']);

    //if username or password is empty the it will display an error message
    if($username ===''){
        $error = 'Please enter username and password.';
    }
    //if password is empty and no error display message
    //NOTE double(&),combines 2 conditions and return true only if both conditions are true
    if($password === '' && $error === ''){
        $error = 'Please enter username and password.';
    }
    if($error===''){              //This will check username and password in the DATABASE

        $conn = mysqli_connect('localhost','root','','daily_discoveries');
        if(!$conn){
            die('connection failed:' .mysqli_connect_error());
        }
        //This part build the query and run it
        $sql = "SELECT id, username, password, role
                FROM users
                WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        //Check if the query succeeded and exactly 1 row was returned then fetch the row
        if($result && mysqli_num_rows($result)=== 1) {
            $row = mysqli_fetch_assoc($result);
            //Check if the pasword matches the one that was stored
            if ($password === $row['password']) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                //Redirect to the home page
                header('Location:Home.php');
                exit;
            
            } else {
                $error = 'Invalid username or password.';  //Display an error message if password do not match
            }
            mysqli_close($conn);
        }

    }
}

?>

<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="CSS File/CSS REG.css">
    <link rel="stylesheet" href="CSS File/Logoimage.css">
    
</head>
<body>
    <!-- Animated background circles -->
    <div class="background-circles">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="glass-container">
        <h2>
            <div id="logo">
                <img src="Images/logo.png" alt="logo" style="width: 70px; height: 70px; margin-left: 2px;">
            </div>
            Login
        </h2>

        <?php if ($error !== ''): ?>                                           <!-- Only execute the following if $error is not an empty string.-->
            <p style="color:red; text-align:center;"><?php echo $error; ?></p> <!--Display the message in red, with centered text-->
        <?php endif; ?>

        <form name="loginInfo" id="loginInfo" action="Login.php" method="POST">
            <div class="input-group">
                <input type="text" id="username" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Remember me
                </label>
                <a href="Forgot.php">Forgot Password?</a>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="RegistrationForm.html">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
