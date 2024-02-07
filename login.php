<?php 
session_start();
if (isset($_POST["login"])) {
    $email = $_POST["loginemail"];
    $password = $_POST["loginpassword"];

     require_once "db_conn.php";

     $sql = "SELECT * FROM users WHERE email = '$email'";
     $result = mysqli_query($conn, $sql);
     $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

     if ($user) {
        if (password_verify($password, $user["password"])) {

            $sql = "SELECT username FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Set cookie after closing the database connection
            if (isset($_COOKIE['old_user'])) {
                setcookie("old_user", "", time() - 3600);
            }
            setcookie("old_user", $user['username'], time() + 86400, "/");
            $_SESSION['cookie'] = $user['username'];

            mysqli_close($conn);
            header("Location: loginsuccessful.php");
            exit();
        }
        else{
            $_SESSION['error_message'] = "Invalid Password.";
        }
     }else{
        $_SESSION['error_message'] = "Email does not exist.";
     }
    header("Location: errormsg.php"); // Redirect to the error page
    exit();
 }
?>