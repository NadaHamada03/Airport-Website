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
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                session_start();
                if (isset($_COOKIE['user_reset'])) {
                    $username = htmlspecialchars($_SESSION['cookie']);
                    echo "<p style='display: inline-block; font-weight: bold; font-size: larger;'>Welcome Back, $username! We've missed you!</p><br>";
                    setcookie("user_reset", "", time() - 3600);   
                }
            ?>
            <p><br><br></p>
        </div>
        <div style="text-align: center;">
            <a href="HomePage-2.html">Click here to start your next journey.</a>
            <p><br><br></p>
        </div>
        <div style="text-align: center;">
            <p>Don't forget your password next time!<br></p>
        </div>
        <div style="text-align: center;">
            <p>Safe Travels!<br></p>
            <p><br></p>
        </div>
        
    </div>
</body>
</html>
