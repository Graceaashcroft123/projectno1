<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'daily_discoveries');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Fetch indoor activities from DB (we will use this later if needed)
$sqlOutdoor = "SELECT name, description, image_path FROM activities WHERE type = 'outdoor' ORDER BY id DESC";
$OutdoorResult = mysqli_query($conn, $sqlOutdoor);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Discoveries-Outdoor</title>
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
            align-items:
                center;
            display:
                flex;
            gap:
                20px;
        }

        .description {
            max-width:
                400px;
        }

        #listofactivities {
            text-align:
                left;
        }

        a {
            color:
                beige;
            text-decoration:
                none;
            font-size:
                20px;
            /*
        REMOVE
        padding:
        10px;
        */
            /*
        REMOVE
        margin-left:
        150px;
        */
        }

        header {
            display:
                flex;
            justify-content:
                space-between;
            align-items:
                center;
            background-image:
                linear-gradient(to bottom,
                    #68a7ad9b,
                    #e6cca9a6);
            padding:
                20px 40px;
        }

        header h1 {
            color:
                #FFFDD0;
            font-size:
                1.5em;
            margin:
                0;
        }

        header {
            padding:
                20px;
        }

        a:hover {
            color:
                yellow;
        }

        form {
            color:
                white;
        }

        h2 {
            color:
                #FFFDD0;
            text-align:
                center;
        }

        legend {
            color:
                #fbfaf9;
        }

        select {
            font-size:
                larger;
            padding:
                12px 40px 12px 15px;
            color:
                #754E1A;
            background-color:
                #e5cb9f9d;
            font-family:
                'Courier
 New',
 Courier,
                monospace;
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

<body>
    <header>
        <h1><a href="Home.php" class="site-title-link">
                <div id="logo">
                    <img src="Images/logo.png" alt="logo">
                </div>
            </a></h1>
        <nav class="gradient-menu">
            <a href="Home.php">Home</a>
            <a href="aindoor.php">Indoor</a>
	        <a href="ContactForm.php">Contact Us</a>
            <a href="RegistrationForm.php">Register</a>
            
            <?php if(isset($_SESSION['username'])): ?>
                <a href='#'>User-<?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="Login.php">Login</a>
            <?php endif; ?>

        </nav>
    </header>
    <form name="activityoutdoor" id="activityoutdoor" action="actoutdoor.php" method="GET">
        <button type="submit" id="submitBtn" onclick="submitActivities()">ACTIVTY DONE</button>
        <label for="difficultylevel" style="font-size: larger; font-family: 'Courier New', Courier, monospace;">Choose
            your difficulty
            level</label>
        <select name="difficultylevel" onchange="if (this.value) window.location=this.value">
            <option>Choose Section</option>
            <option value="#easy">Easy</option>
            <option value="#medium">Medium</option>
            <option value="#hard">Hard</option>
        </select>
        <a id="easy"></a>

        <!-- EASY LEVEL -->
        <fieldset>
            <legend>Level: Easy</legend>

            <!-- Leaf Detective -->

            <input type="checkbox" id="actOut1">
            <label for="actOut1">Leaf Detective</label><br>
            <div class="container">

                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/leaf0.png">
                        <img src="Images/Leafsheet.jpg">
                        <img src="Images/leaf1.jpg">
                        <img src="Images/leaf2.jpg">
                        <img src="Images/leaf3.jpg">
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>Hunt for leaves of various shapes. <br>Compare, sketch, and collect as a nature detective!</p>
                </div>
            </div>
            <br>
            <!-- Color Hunt -->

            <input type="checkbox" id="actOut2">
            <label for="actOut2">Color Hunt</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/col1.png" />
                        <img src="Images/col2.png" />
                        <img src="Images/col3.png" />
                        <img src="Images/col4.png" />
                        <img src="Images/col5.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Find items matching the color list. Can you spot every color of the rainbow?
                    </p>
                </div>
            </div>
            <br>
            <!-- Balance Beam Walk -->

            <input type="checkbox" id="actOut3">
            <label for="actOut3">Balance Beam Walk</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/Bal1.png" />
                        <img src="Images/Bal2.png" />
                        <img src="Images/Bal3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Walk along a curb, rope, or beam to practice balance and coordination.
                    </p>
                </div>
            </div>
            <br>

            <!-- Nature Treasure Hunt -->

            <input type="checkbox" id="actOut4">
            <label for="actOut4">Nature Treasure Hunt</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/Ht1.png" />
                        <img src="Images/Ht2.png" />
                        <img src="Images/Ht3.png" />
                        <img src="Images/Ht4.png" />
                        <img src="Images/Ht5.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <p>
                        Search for natural treasures—like rocks, acorns, or flowers—and check them off your list!
                    </p>
                </div>
            </div>
            <br>
            <!-- Cloud Spotting -->

            <input type="checkbox" id="actOut5">
            <label for="actOut5">Cloud Spotting</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/cloud1.png" />
                        <img src="Images/cloud2.png" />
                        <img src="Images/cloud3.png" />
                        <img src="Images/cloud4.png" />
                        <img src="Images/cloud5.png" />
                        <img src="Images/cloud6.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Lay back and watch the clouds. Can you spot animals or objects in their shapes?
                    </p>
                </div>
            </div>
        </fieldset>
        <a id="medium"></a>
        <!-- MEDIUM LEVEL -->
        <fieldset>
            <legend>Level: Medium</legend>
            <!-- Tree Hug Challenge -->

            <input type="checkbox" id="actOut6">
            <label for="actOut6">Tree Hug Challenge</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/treehug1.png" />
                        <img src="Images/treehug2.png" />
                        <img src="Images/treehug3.png" />
                        <img src="Images/treehug4.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Hug as many different trees as you can—note the bark texture for each one!
                    </p>
                </div>
            </div>
            <br>
            <!-- Walk in Shapes -->

            <input type="checkbox" id="actOut7">
            <label for="actOut7">Walk in Shapes</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/shape1.png" />
                        <img src="Images/shape2.png" />
                        <img src="Images/shape3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Walk, jump, or hop along shapes drawn outside—circles, <br>squares, triangles, and your own
                        invention!
                    </p>
                </div>
            </div>
            <br>
            <!-- Kindness Drop -->

            <input type="checkbox" id="actOut10">
            <label for="actOut10">Kindness Drop</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/kindness1.png" />
                        <img src="Images/kindness2.png" />
                        <img src="Images/kindness3.png" />
                        <img src="Images/kindness4.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Leave a note, flower, or pebble for someone as a surprise act of kindness!
                    </p>
                </div>
            </div>
            <!-- Hopscotch Challenge -->

            <input type="checkbox" id="actOut11">
            <label for="actOut11">Hopscotch Challenge</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/hopscotch1.png" />
                        <img src="Images/hopscotch2.png" />
                        <img src="Images/hopscotch3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Play a round of hopscotch—get creative with your number or pattern layout!
                    </p>
                </div>
            </div>
        </fieldset>
        <a id="hard"></a>
        <!-- HARD LEVEL -->
        <fieldset>
            <legend>Level: Hard</legend>
            <!-- Stones Jacks (gonggi nori) -->

            <input type="checkbox" id="actOut8">
            <label for="actOut8">Stones Jacks (gonggi nori)</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/stones1.png" />
                        <img src="Images/stones2.png" />
                        <img src="Images/stones3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Play the traditional stones jacks game—toss and catch stones in increasing challenge rounds!
                    </p>
                </div>
            </div>

            <!-- Target Shooting (with safe items) -->

            <input type="checkbox" id="actOut9">
            <label for="actOut9">Target Shooting (with safe items)</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/target1.png" />
                        <img src="Images/target2.png" />
                        <img src="Images/target3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Toss socks, beanbags, or balls at homemade targets—challenge yourself to beat your score!
                    </p>
                </div>
            </div>
            <br>

            <!-- Marble Toss -->

            <input type="checkbox" id="actOut12">
            <label for="actOut12">Marble Toss</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/marble1.png" />
                        <img src="Images/marble2.png" />
                        <img src="Images/marble3.png" />
                        <img src="Images/marble4.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description:</h3>
                    <p>
                        Compete in marble toss—try to land them in a cup, circle, or marked target.
                    </p>
                </div>
            </div>
            <br>

            <!-- Red Light, Green Light (solo version) -->

            <input type="checkbox" id="actOut13">
            <label for="actOut">Red Light, Green Light (solo version)</label><br>
            <div class="container">
                <div class="carousel">
                    <div class="carousel-images">
                        <img src="Images/redlight1.png" />
                        <img src="Images/redlight2.png" />
                        <img src="Images/redlight3.png" />
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <p>
                        Play Red Light, Green Light by calling out and moving—see how quickly you can stop!
                    </p>
                </div>
            </div>
        </fieldset>
        <div id="feedbackBox">
            <label for="fb1">YOUR EXPERIENCE:</label><br>
            <textarea id="fb1" rows="6" cols="30" placeholder="TELL US ABOUT YOUR EXPERIENCE AFTER DOING THIS ACTIVITY:"
                style="text-align: center; font-family: 'Courier New', Courier, monospace; background-color: #99c4c834; color:white;"></textarea>
            <button type="submit" onclick="alert('Feedback Submitted!')" style="background-color: #99c4c834;"> Share
                With Us!</button>
            <button type="reset" style="background-color: #99c4c834;"> Try another activity</button>
        </div>
    </form>

    <!-- Fullscreen Image -->
    <div id="carousel-fullscreen" style="display:none;">
        <span id="carousel-close"
            style="
        position:absolute; top:15px; right:35px; color:white; font-size:40px; cursor:pointer; z-index:1002;">&times;</span>
        <img id="carousel-fullscreen-img" src="" alt="Full screen image"
            style="
        display:block; margin:auto; max-width:98vw; max-height:98vh; width:auto; height:auto; border-radius:12px; box-shadow:0 0 25px #000; z-index:1001;" />
    </div>
<?php 
// Display all outdoor activities from the database (name, description, optional image)
// This loops through $OutdoorResult and prints each activity in a styled list for the public page.
if ($OutdoorResult && mysqli_num_rows($OutdoorResult) > 0): ?>
    <div style="max-width:900px; margin:30px auto; background-color:rgba(0,0,0,0.4); padding:20px; border-radius:12px; color:#FFFDD0;">
        <h2>Our Outdoor Activities (from database)</h2>
        <?php while ($row = mysqli_fetch_assoc($OutdoorResult)): ?>
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
        No outdoor activities found in the database.
    </p>
<?php endif; ?>
    <footer>
        &copy; 2025 Daily Discoveries | Outdoor Activities & Learning Fun
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
            var task1 = document.getElementById("actOut1").checked;
            var task2 = document.getElementById("actOut2").checked;
            var task3 = document.getElementById("actOut3").checked;
            var task4 = document.getElementById("actOut4").checked;
            var task5 = document.getElementById("actOut5").checked;
            var task6 = document.getElementById("actOut6").checked;
            var task7 = document.getElementById("actOut7").checked;
            var task8 = document.getElementById("actOut8").checked;
            var task9 = document.getElementById("actOut9").checked;
            var task10 = document.getElementById("actOut10").checked;
            var task11 = document.getElementById("actOut11").checked;
            var task12 = document.getElementById("actOut12").checked;
            var task13 = document.getElementById("actOut13").checked; // Last Red Light, Green Light
            if (
                task1 || task2 || task3 || task4 || task5 ||
                task6 || task7 || task8 || task9 || task10 ||
                task11 || task12 || task13
            ) {
                document.getElementById("feedbackBox").style.display = "block";
                window.scrollTo(0, document.body.scrollHeight);
            } else {
                alert("Please select at least one activity before submitting.");
            }
        }
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>