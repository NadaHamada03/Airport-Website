<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["sendmsg"])) {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["msg"];
     
    if (empty($name)) {
        $errorMessage = "Enter your name";
        echo "<script>alert(' $errorMessage');</script>";
    }
    elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address";
        echo "<script>alert(' $errorMessage');</script>";
    } 
    elseif (empty($msg)) {
        $errorMessage = "Enter your message";
        echo "<script>alert(' $errorMessage');</script>";
    }
    else {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'skyharbourteam@gmail.com';
            $mail->Password = 'jzbrjnviryuhnbdl';
            $mail->SMTPSecure = 'tls'; // Updated to use TLS
            $mail->Port = 587; // Updated port for TLS

            // Recipient
            $mail->setFrom('skyharbourteam@gmail.com');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);

            $subject = "We've got your back!";
            $body = "<strong>Thank you for reaching out to us!</strong><br><br>We want to let you know our team is doing their best to stay on top of all requests. We will get back to you as soon as possible.<br><br>Keep an eye out for any emails from us within the next 2 days.<br><br>Sincerely,<br>Sky Harbour Team.";

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->SMTPDebug = 2; // Enable debugging

            $mail->send();
            
            header("Location: HomePage.html");
            exit();
        } 
        catch (Exception $e) {
            header("Location: emailerror.php");
            exit();
        }    
    }
}
?>
