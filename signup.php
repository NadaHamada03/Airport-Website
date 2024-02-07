<?php
session_start();
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpassword"];

    require_once "db_conn.php";

    // Use prepared statement to prevent SQL injection
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $rowCount = mysqli_stmt_num_rows($stmt);

    if ($rowCount > 0) {
        $_SESSION['error_message'] = "Email already exists!";
        header("Location: errormsg.php"); // Redirect to the error page
        exit();
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] =  "Invalid email.";
            header("Location: errormsg.php"); 
            exit();
        }
        if (strlen($password) < 8) {
            $_SESSION['error_message'] =  "Password must be at least 8 characters long.";
            header("Location: errormsg.php"); 
            exit();
        }
        if ($password !== $confirmpass) {
            $_SESSION['error_message'] = "Passwords do not match.";
            header("Location: errormsg.php"); 
            exit();
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statement to prevent SQL injection
        $insertUserQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $insertUserQuery);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Set cookie after closing the database connection
            if (isset($_COOKIE['newuser'])) {
                setcookie("newuser", "", time() - 3600);
            }
            setcookie("newuser", $username, time() + 86400, "/");
            $_SESSION['cookie'] = $username;

            header("Location: signupsuccessful.php"); 
            exit();
        } else {
            $_SESSION['error_message'] =  "Error: " . mysqli_stmt_error($stmt);
            header("Location: errormsg.php"); 
            exit();
        }
    }
}
?>
