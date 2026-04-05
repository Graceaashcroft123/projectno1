<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'daily_discoveries');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Fetch indoor activities from DB (we will use this later if needed)
$sqlIndoor = "SELECT name, description, image_path FROM activities WHERE type = 'indoor' ORDER BY id DESC";
$indoorResult = mysqli_query($conn, $sqlIndoor);
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily Discoveries-Indoor</title>
	<link rel="stylesheet" href="CSS File/Styles.css" />
	<link rel="stylesheet" href="CSS File/Logoimage.css" />
	<style>
		body {
			background-image: url('Images/indoorBg.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			font-family: 'Courier New', Courier, monospace;
			background-size: cover;
			margin: 0;

		}

		.container {
			align-items: center;
			display: flex;
			gap: 20px;
		}

		.description {
			max-width: 400px;
		}

		#listofactivities {
			text-align: left;
		}


		a {
			color: beige;
			text-decoration: none;
			font-size: 20px;
			/*  REMOVE padding: 10px; */
			/*  REMOVE margin-left: 150px; */
		}

		header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-image: linear-gradient(to bottom, #68a7ad9b, #e6cca9a6);
			padding: 20px 40px;
		}

		header h1 {
			color: #FFFDD0;
			font-size: 1.5em;
			margin: 0;
		}

		header {
			padding: 20px;
		}

		a:hover {
			color: yellow;
		}

		form {
			color: white;

		}

		h2 {
			color: #FFFDD0;
			text-align: center;
		}

		legend {
			color: #fbfaf9;

		}

		select {
			font-size: larger;
			padding: 12px 40px 12px 15px;
			color: #754E1A;
			background-color: #e5cb9f9d;
			font-family: 'Courier New', Courier, monospace;
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

		#submitBtn {
			position: fixed;
			bottom: 20px;
			right: 20px;
			padding: 10px 20px;
			background-color: #b4812b;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		#submitBtn:hover {
			background-color: #50f49a;
		}



		#feedbackBox {
			display: none;
			margin-top: 20px;
			text-align: center;
		}

		textarea {
			width: 300px;
			height: 80px;
			margin-top: 5px;
		}

		button {
			margin-top: 10px;
			cursor: pointer;
		}
	</style>
</head>


</head>

<body>
	<header>
		<h1><a href="Home.php" class="site-title-link">
				<div id="logo">
					<img src="Images/logo.png" alt="logo">
				</div>
			</a></h1>
		<nav class="gradient-menu">
			<a href="Home.php">Home</a>
			<a href="aoutdoor.php">Outdoor</a>
			<a href="ContactForm.html">Contact Us</a>
			<a href="RegistrationForm.php">Register</a>
		<!--Check if a user is logged in using the session-->
		<!--If logged in: show a welcome message + Logout link-->
		<!--If not logged in: show the Login link-->
			<?php if(isset($_SESSION['username'])): ?>
                <a href='#'>User-<?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="Login.php">Login</a>
            <?php endif; ?>

		</nav>
	</header>
	<div id="listofactivities">
		<h2>Please select one indoor activity</h2>

		<form name="activityindoor" id="activityindoor" action="actindoor.php" method="GET">
			<button type="submit" id="submitBtn" onclick="submitActivities()">ACTIVTY DONE</button>
			<fieldset>
				<label for="difficultylevel"
					style="font-size: larger; font-family: 'Courier New', Courier, monospace;">Choose your difficulty
					level</label>
				<select name="difficultylevel" onchange="if (this.value) window.location=this.value">
					<option>Choose Section</option>
					<option value="#easy">Easy</option>
					<option value="#medium">Medium</option>
					<option value="#hard">Hard</option>
				</select>
				<a id="easy"></a>

				<legend>Level: Easy</legend>

				<input type="checkbox" id="actIn1">
				<label for="actIn1">Speed origami</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/origami1.png" />
							<img src="Images/origami2.png" />
							<img src="Images/origami3.png" />
							<img src="Images/origami4.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">
							<p>Fold a simple origami frog in less than 3 minutes!<br>You should totally try making a
								paper origami frog.<br>It is super fun, easy to fold
								and the best part is it actually hops when you press it!</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn2">
				<label for="actIn2">3 minutes Outfit Swap</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/outfit1.png" />
							<img src="Images/outfit2.png" />
							<img src="Images/outfit3.png" />
							<img src="Images/outfit4.jpg" />

						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">
							<p>Put on the funniest combination of clothes you can in 3 minutes!</p>
						</div>
					</div>
				</div>
			</fieldset>

			<input type="checkbox" id="actIn3">
			<label for="actIn3">Dance Like nobody's watching</label>
			<div class="container">
				<div class="carousel">
					<div class="carousel-images">
						<img src="Images/dance1.png" />
						<img src="Images/dance2.jpg" />
						<img src="Images/dance3.png" />
						<video src="Images/dance4.mp4" controls width="600px" height="250px"></video>

					</div>
					<button class="carousel-btn prev">❮</button>
					<button class="carousel-btn next">❯</button>
				</div>
				<div class="description">
					<h4>Description:</h4>
					<div id="indoor">

						<p>For 3 minutes perform a freestyle dance.<br>This will help you to ease your
							stress!
						</p>
					</div>
				</div>
			</div>
			<br>

			<input type="checkbox" id="actIn4">
			<label for="actIn4">Upside down challenge</label>
			<div class="container">
				<div class="carousel">
					<div class="carousel-images">
						<img src="Images/read1.png" />
						<img src="Images/read2.png" />
						<img src="Images/read3.png" />
					</div>
					<button class="carousel-btn prev">❮</button>
					<button class="carousel-btn next">❯</button>
				</div>
				<div class="description">
					<h4>Description:</h4>
					<div id="indoor">

						<p>Read a page of a book upside down and try to undertand what is
							written on
							the
							page!
						</p>
					</div>
				</div>
			</div>
			<br>

			<input type="checkbox" id="actIn5">
			<label for="actIn5">Blind doodle challenge</label>
			<div class="container">
				<div class="carousel">
					<div class="carousel-images">
						<img src="Images/blind1.png" />
						<img src="Images/blind2.png" />
						<img src="Images/blind3.png" />
					</div>
					<button class="carousel-btn prev">❮</button>
					<button class="carousel-btn next">❯</button>
				</div>
				<div class="description">
					<h4>Description:</h4>
					<div id="indoor">

						<p>Close your eyes and try to draw an animal and write your name with
							your
							non-dominant
							hand!</p>
					</div>
				</div>
			</div>
			</fieldset>
			<a id="medium"></a>
			<fieldset>
				<legend>Level : Medium</legend>

				<input type="checkbox" id="actIn6">
				<label for="actIn6">Bake a cake</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/bake1.png" />
							<img src="Images/bake2.png" />
							<img src="Images/bake3.png" />
							<iframe width="600" height="250"
								src="https://youtube.com/shorts/Qyy_2KjyCyw?si=OdHH109KZXNTVxjk" frameborder="0"
								allow="accelerometer; autoplay; 								encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen>
							</iframe>

						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Try baking a cake using just a mug, a microwave and a few ingredients!</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn7">
				<label for="actIn7">Shadow Puppet Story</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/sha1.png" />
							<img src="Images/sha2.png" />
							<img src="Images/sha3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Turn off the lights, use a torch, and make a mini story with hand Shadow!
							</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn12">
				<label for="actIn12">3 minutes Room Concert</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/sing1.png" />
							<img src="Images/sing2.png" />
							<img src="Images/sing3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Sing your favourite song loudly with a spoon or hairbrush as a microphone.
								<br>Here's
								a little twist: Instead of singing along, speak the lyrics dramatically like you are in
								a
								theater!
							</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn13">
				<label for="actIn13">3 minutes Room Makeover</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/room1.png" />
							<img src="Images/room2.png" />
							<img src="Images/room3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Rearrange at least 3 things in your room in 3 minutes to give it a "new vibe"
							</p>
						</div>
					</div>
				</div>
			</fieldset>
			<a id="hard"></a>
			<fieldset>
				<legend>Level: Hard</legend>

				<input type="checkbox" id="actIn8">
				<label for="actIn8">Card Flip(ddakji)</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/ddakji1.png" />
							<img src="Images/ddakji2.png" />
							<img src="Images/ddakji3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Ddakji(Card Flip) is a traditional Korean game where players flip paper tiles by
								slamming their own folded tile onto them. You can make your own in less than
								5minutes!<br>Rules:
								Drop one tile onto another to try flipping it over!</p>

						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn9">
				<label for="actIn9">Sock Basket Ball</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/sock1.png" />
							<img src="Images/sock2.png" />
							<img src="Images/sock3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Roll up a sock into a ball and shoot it into a basket/bin from different
								distances!
							</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn10">
				<label for="actIn10">DIY Dalgona Candy Challenge</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/dalgona1.png" />
							<img src="Images/dalgona2.png" />
							<img src="Images/dalgona3.png" />
							<img src="Images/dalgona4.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">

							<p>Make dalgona candy by melting sugar + baking soda then try to carve the
								shape in 3 minutes!<br> If no candy, just draw a shape on paper and carefully and cut it
								out
								with a toothpick<br>Be careful when heating the sugar!</p>
						</div>
					</div>
				</div>
				<br>

				<input type="checkbox" id="actIn11">
				<label for="actIn11">Cup Pyramid Race</label>
				<div class="container">
					<div class="carousel">
						<div class="carousel-images">
							<img src="Images/cup1.png" />
							<img src="Images/cup2.png" />
							<img src="Images/cup3.png" />
						</div>
						<button class="carousel-btn prev">❮</button>
						<button class="carousel-btn next">❯</button>
					</div>
					<div class="description">
						<h4>Description:</h4>
						<div id="indoor">
							<p> Stack plastic cups into pyramid as fast as you can, then unstack them without dropping
								them!
							</p>
						</div>
					</div>
				</div>
			</fieldset>
			<div id="feedbackBox">
				<label for="fb1">YOUR EXPERIENCE:</label><br>
				<textarea id="fb1" rows="6" cols="30"
					placeholder="TELL US ABOUT YOUR EXPERIENCE AFTER DOING THIS ACTIVITY:"
					style="text-align: center; font-family: 'Courier New', Courier, monospace; background-color: #99c4c834; color:white;"></textarea>
				<button type="submit" onclick="alert('Feedback Submitted!')" style="background-color: #99c4c834;"> Share
					With Us!</button>
				<button type="reset" style="background-color: #99c4c834;"> Try another activity</button>
			</div>
		</form>
<?php 
// Display all indoor activities from the database (name, description, optional image)
// This loops through $indoorResult and prints each activity in a styled list for the public page.
if ($indoorResult && mysqli_num_rows($indoorResult) > 0): ?>
    <div style="max-width:900px; margin:30px auto; background-color:rgba(0,0,0,0.4); padding:20px; border-radius:12px; color:#FFFDD0;">
        <h2>Our Indoor Activities (from database)</h2>
        <?php while ($row = mysqli_fetch_assoc($indoorResult)): ?>
            <div style="border-bottom:1px solid rgba(255,255,255,0.3); padding:10px 0; display:flex; gap:15px;">
                <?php if (!empty($row['image_path'])): ?>
                    <div>
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>"
                             alt="Activity image"
                             style="width:120px; height:80px; object-fit:cover; border-radius:8px;">
                    </div>
                <?php endif; ?>
                <div>
                    <h3 style="margin:0 0 5px 0; color:#ffe9b3;">
                        <?php echo htmlspecialchars($row['name']); ?>
                    </h3>
                    <p style="margin:0;">
                        <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p style="text-align:center; color:#FFFDD0; margin-top:30px;">
        No indoor activities found in the database.
    </p>
<?php endif; ?>
	</div>
	<!-- Fullscreen Image -->
	<div id="carousel-fullscreen" style="display:none;">
		<span id="carousel-close"
			style="
        		position:absolute; top:15px; right:35px; color:white; font-size:40px; cursor:pointer; z-index:1002;">&times;</span>
		<img id="carousel-fullscreen-img" src="" alt="Full screen image"
			style="
        		display:block; margin:auto; max-width:98vw; max-height:98vh; width:auto; height:auto; border-radius:12px; box-shadow:0 0 25px #000; z-index:1001;" />
	</div>

	<footer>
		&copy; 2025 Daily Discoveries | Indoor Activities & Learning Fun
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
	<script src="JavaScript/JavaS.js"></script>
	<script>
		function submitActivities() {
			var task1 = document.getElementById("actIn1").checked;
			var task2 = document.getElementById("actIn2").checked;
			var task3 = document.getElementById("actIn3").checked;
			var task4 = document.getElementById("actIn4").checked;
			var task5 = document.getElementById("actIn5").checked;
			var task6 = document.getElementById("actIn6").checked;
			var task7 = document.getElementById("actIn7").checked;
			var task8 = document.getElementById("actIn12").checked;
			var task9 = document.getElementById("actIn13").checked;
			var task10 = document.getElementById("actIn8").checked;
			var task11 = document.getElementById("actIn9").checked;
			var task12 = document.getElementById("actIn10").checked;
			var task13 = document.getElementById("actIn11").checked;
			if (task1 || task2 || task3 || task4 || task5 || task6 || task7 || task8 || task9 || task10 || task11 || task12 || task13) {
				document.getElementById("feedbackBox").style.display = "block";
				window.scrollTo(0, document.body.scrollHeight); // scroll to feedback box
			} else {
				alert("Please select at least one activity before submitting.");
			}
		}
	</script>
</body>

</html>