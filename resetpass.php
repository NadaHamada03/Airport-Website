<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (isset($_POST["reset"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    require_once "db_conn.php";

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $rowCount = mysqli_stmt_num_rows($stmt);

    if ($rowCount > 0) {
        if (strlen($password) < 8) {
            $_SESSION['error_message'] =  "Password must be at least 8 characters long.";
            header("Location: errormsg.php"); // Redirect to the error page
            exit();

        } 
        elseif ($password !== $confirmpass) {
            $_SESSION['error_message'] = "Passwords do not match.";
            header("Location: errormsg.php"); // Redirect to the error page
            exit();
        } 
        else {
            // Check if the new password is different from the one in the database
            $checkPasswordQuery = "SELECT password FROM users WHERE email = ?";
            $stmt_check = mysqli_prepare($conn, $checkPasswordQuery);
            mysqli_stmt_bind_param($stmt_check, "s", $email);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);

            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                mysqli_stmt_bind_result($stmt_check, $storedPassword);
                mysqli_stmt_fetch($stmt_check);

                // Verify if the new password is different from the stored one
                if (password_verify($password, $storedPassword)) {
                    $_SESSION['error_message'] = "New password must be different from the current password.";
                    header("Location: errormsg.php"); 
                    exit();
                } 
                else {
                    // Use prepared statement to prevent SQL injection
                    $insertUserQuery = "UPDATE users SET password = ? WHERE email = ?";
                    $stmt_update = mysqli_prepare($conn, $insertUserQuery);
                    mysqli_stmt_bind_param($stmt_update, "ss", $passwordHash, $email);

                    if (mysqli_stmt_execute($stmt_update)) {

                        $sql = "SELECT username FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        // Set cookie after closing the database connection
                        if (isset($_COOKIE['user_reset'])) {
                            setcookie("user_reset", "", time() - 3600);
                        }

                        setcookie("user_reset", $user['username'], time() + 86400, "/");
                         $_SESSION['cookie'] = $user['username'];

                        mysqli_close($conn); 

                        header("Location: resetsuccessful.php"); 
                        exit();

                    } else {
                        $_SESSION['error_message'] = "Failed to reset password.";
                        header("Location: errormsg.php"); 
                        exit();
                        
                    }
                }
            }
        }
    } else {
        $_SESSION['error_message'] = "Email does not exist.";
        header("Location: errormsg.php"); 
        exit();
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
}
?>
