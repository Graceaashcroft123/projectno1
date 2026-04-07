<?php
session_start();

if (isset($_SESSION['reg_success']) && $_SESSION['reg_success'] === false) {
    echo "<script>alert('This email address already exists! Please log in instead.');</script>";
    unset($_SESSION['reg_success']); // clear flag after showing it
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registration</title>
    <link rel="stylesheet" href="CSS File/CSS REG.css">
    <link rel="stylesheet" href="CSS File/Logoimage.css">
    <script>
        function FormValidation(event) {
            let username = document.getElementById("username").value.trim();
            let password = document.getElementById("userPass").value.trim();

            if (username === "") {
                alert("Please enter your username!");
                event.preventDefault();
                return false;
            }
            if (password === "") {
                alert("Please enter your password!");
                event.preventDefault();
                return false;
            }
            if (password.length < 6) {
                alert("Password must be at least 6 characters!");
                event.preventDefault();
                return false;
            }
            // If all checks pass
            //alert("Registration successful!");
            return true;
        }
    </script>
    <script>

        function ajax() {
            try {
                requestbox = new XMLHttpRequest();
            }
            catch (e) { alert("Your browser does not support AJAX !"); }
            var uname = document.regform.username.value;
            url = "checkuname.php?username=" + uname;
            requestbox.open("GET", url, true);
            requestbox.onreadystatechange = displayResult;
            requestbox.send(null);
        }
        function displayResult() {
             if ((requestbox.readyState == 4) && (requestbox.status == 200)) {
            var response = requestbox.responseText.trim();
            document.getElementById('message').innerHTML = response;
            //use of JQuery Library (red border means username already exists and green border means username is available)
            if (response.includes("valid")) { 
                $('#username').css('border', '2px solid green');
                $('#message').css('color', 'green');
            } else {
            $('#username').css('border', '2px solid red');
            $('#message').css('color', 'red');
            }
        }
    }

    </script>
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
                <img src="Images/logo.png" alt="logo">
            </div>
            Register
        </h2>
        <form name="regform" id="regform" action="regform.php" method="GET" onsubmit="return FormValidation(event)">
            <div class="input-group">
                <input type="text" name="username" id="username" required onblur="ajax()">
                <label for="username">Username</label>
                <div id='message'></div>
            </div>
            <div class="input-group">
                <input type="email" name="emailadd" id="emailadd" required>
                <label for="emailadd">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="userPass" id="userPass" required>
                <label>Password</label>
            </div>
            <button type="submit" class="login-btn">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="Login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>