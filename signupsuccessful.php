<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_css.css">
    <title>Successful Login</title>
</head>
<body>
    <nav>
        <img src="HomePagePics/world.png" alt="Airplane Logo">
        <a href="HomePage-2.html">Home</a>
        <a href="About-2.html">About</a>
        <a href="ContactUs-2.html">Contact Us</a>
        <a href="Booking.html">Booking</a>
        <a href="Tracking-2.html">Tracking</a>
        <a class="Login" href="HomePage.html">Log-out</a>
    </nav>
    <div class="image-slideshow">
    </div>
    <div class="translucent-box">
        <div style="text-align: center;">
            <?php
                session_start();
                if (isset($_COOKIE['newuser'])) {
                    $username = htmlspecialchars($_SESSION['cookie']);
                    echo "<p style='display: inline-block; font-weight: bold; font-size: larger;'>Welcome, $username!</p><br>";
                    setcookie("user", "", time() - 3600);   
                }
                ?>
            <p><br></p>
            <p style="display: inline-block; font-weight: bold; font-size: larger;">Thank You For Choosing Sky Harbor Airport!<br></p>
            <p><br></p>
        </div>
        <div style="text-align: center;">
            <a href="HomePage-2.html">Click here to start your experience.</a>
            <p><br></p>
        </div>
        <div style="text-align: center;">
            <p>Safe Travels!<br></p>
            <p><br></p>
        </div>
        
    </div>
</body>
</html>
