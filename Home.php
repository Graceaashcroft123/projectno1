<?php
session_start();
//This forces users to log in before seeing Home For every page that should only be used after login (e.g. future CRUD pages, admin pages), put the same block at the top:

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="CSS File/Styles.css" />
  <link rel="stylesheet" href="CSS File/Logoimage.css" />
  <style>
    header {
      background-color: transparent;
    }

    body {
      background-image: url('Images/indexBg.JPG');
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: 'Courier New', Courier, monospace;
      background-size: cover;
      margin: 0;
      text-align: center;
      justify-content: center;
    }

    .flex-container {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      font-size: larger;
      color: rgb(108, 64, 7);

    }

    .text-block {
      padding: 20px;
      border: 1px solid #ccc;
      margin: 10px;
      flex: 1;
      background-color: #e5cb9f22;
    }

    a {
      color: rgb(108, 64, 7);
    }

    a:hover {
      color: #e3a843;
    }

    footer {
      width: 100%;
      background-color: #E5CB9F;
      color: #333;
      text-align: center;
      padding: 18px 0 16px 0;
      font-size: 1.1em;
      position: relative;
      margin-top: 32px;
      letter-spacing: 1px;
    }

    .second-footer {
      width: 100%;
      background-color: #EEE4AB;
      color: #333;
      text-align: center;
      padding: 17px 0 13px 0;
      font-size: 1.1em;
      letter-spacing: 1px;
    }
  </style>
</head>

<body>
  <header>
    <h1><a href="Home.php" class="site-title-link">
        <div id="logo">
          <img src="Images/logo.png" alt="logo">
        </div>
      </a></h1>
    <nav class="gradient-menu">
      <a href="aindoor.php">Indoor</a>
      <a href="/projectno1/aoutdoor.php">Outdoor</a>
      <a href="ContactForm.html">Contact Us</a>
      <a href="RegistrationForm.html">Register</a>
      <!--<a href="Login.php">Login</a>-->

      <!--Admin Only link(John) -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="Logout.php">Logout</a>      <!--If user is logged in, show Logout link -->
      <?php else: ?>
        <a href="Login.php">Login</a>        <!--If user is not logged in show Login link -->
      <?php endif; ?>
      <!-- Show Admin link only if user is logged in AND has role 'admin' -->
      <?php if (isset($_SESSION['user_id']) && $_SESSION['role']==='admin'):?>
        <a href="AdminDashboard.php">Admin</a>
      <?php endif; ?>
    </nav>
    
  </header>
  <div class="indexContainer">
    <h1 style="color:  rgb(108, 64, 7);">
      <img src="Images/logo.png" alt="Daily Discoveries Logo"
        style="width: 150px; height: 150px; display: block; margin: 0 auto;">
      <br>DAILY DISCOVERIES
    </h1>
    <h4 style="color:  rgb(108, 64, 7);">Boredom doesn't stand a chance here!<br> Daily Discoveries gives you quick and
      fun<br>
      indoor or outdoor
      activities
      to
      try anytime!</h4>
    <div class=" flex-container">
      <div class="text-block">
        <h5><a href="aindoor.html">Indoor Activities</a></h5>
        <p>Turn your home into a playground! <br>Discover creative and easy-to-do activities
          that bring fun, relaxation,
          and a spark of adventure right inside your room — no special equipment needed.
        </p>

      </div>
      <div class="text-block">
        <h5><a href="aoutdoor.html">Outdoor Activities</a></h5>
        <p>Step outside and breathe in the excitement!
          <br>Explore quick outdoor challenges and mini-games<br> that get you moving, boost your mood,<br> and make
          every
          outing feel like an adventure.
        </p>
      </div>
    </div>
    <footer>
      &copy; 2025 Daily Discoveries | Activities & Learning Fun
    </footer>
    <div class="second-footer">
      <span>Follow Us:&nbsp;</span>
      <span class="social-flex">
        <a href="https://discord.gg/n4U4xrXk" target="_blank">
          <img src="Images/DiscordBlack.png" alt="Discord">
        </a>
        <a href="https://chat.whatsapp.com/K8FOKO28LOSEPVYINs277R?mode=ems_copy_t" target="_blank">
          <img src="Images/Whatapp.png" alt="WhatsApp">
        </a>
      </span>
    </div>

</body>

</html>