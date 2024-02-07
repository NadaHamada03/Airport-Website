<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_css.css">
    <title>Error Page</title>
</head>
<body>
<div class="image-slideshow">
    </div>
    <div class="translucent-box">
        <div style="text-align: center;">
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo "<p style='display: inline-block; font-weight: bold; font-size: larger;'>" . htmlspecialchars($_SESSION['error_message']) . "<br></p>";
            }
            ?><p><br></p>
        </div>      
        <div style="text-align: center;">
            <a href="Login.html">Go Back</a>
        </div>  
    </div>
</body>
</html>
