<?php
session_start();
//Initialise an empty message to show feedback later
$message = '';
//Check if form was submitted
//NOTE double(?), returns the left operand if it exists and is not null
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');        //Get the email from the form and remove the extra spaces otherwise empty string if not set

    if ($email === '') {                        //If email/username field is empty show error message
        $message = 'Please enter your username or email.';
    } else {                                   //If entered something will show message
        $message = 'If this account exists, the administrator will help you reset your password. Please contact support.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="CSS File/CSS REG.css">
    <link rel="stylesheet" href="CSS File/Logoimage.css">
    <script>
        function validateForgotForm(event) {
            var email = document.getElementById("email").value.trim();
            if (email === "") {
                alert("Please enter your username or email.");
                event.preventDefault();
                return false;
            } else {
                alert("Password reset link sent.");
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
                <img src="Images/logo.png" alt="logo" style="width: 70px; height: 70px; margin-left: 2px;">
            </div>
            ResetPassword
        </h2>
        
         <!-- Show the message in green and centered, only if $message is not an empty string -->
         <!-- NOTE htmlspecialchars converts special characters to HTML entities ,that is if you pass HTML or script form it won't execute as a code -->
         <!--NOTE its just for security/(trying) and this part is not necessary-->
        <?php if ($message !== ''): ?>       
            <p style="color:#0f0; text-align:center;"><?php echo htmlspecialchars($message); ?></p>   
        <?php endif; ?>

        <form name="forgotPasswordForm" id="forgotPasswordForm" action="Forgot.php" method="post" onsubmit="validateForgotForm(event)">
            <div class="input-group">
                <input type="text" id="email" name="email" required>
                <label>Username or Email</label>
            </div>
            <button type="submit" class="login-btn">Send Reset Link</button>
            <div class="register-link">
                <p><a href="Login.php">Back to Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
