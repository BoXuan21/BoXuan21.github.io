<?php
// Start a PHP session
session_start();
//if (!empty($_POST["submitRegistration"])) 
// Check if the form is submitted

if (!empty ($_POST["Register"])) {
    // Retrieve form data
    $newUsername = $_POST['newUsername'];
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    //$hashed_passwort = password_hash($newPasswort, PASSWORD_DEFAULT);

    include __DIR__ . '/../includes/dbaccess.php';

    // Check if the username or email already exists in the database
    $result = mysqli_query($con, "SELECT * FROM `tbl_users` WHERE user_name = '$newUsername' OR user_email = '$email'"); //user_name = '$newUsername' OR user_email = '$email' OR 
    //var_dump($result);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen

    if ($result->num_rows > 0) {
        // Username or email already exists, redirect back to the registration page with an error message
        $_SESSION['error'] = 2; //set two to display message on register
        header("Location: /Semester2/website/sites/register.php#error=2");
        exit();
    } else {
        // Insert new user into the database [Must use `` and not '' otherwise it wont work]
        mysqli_query($con, "INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_password`)
              VALUES (NULL, '$newUsername', '$email', '$newPassword')");
        $_SESSION['accountCreated'] = true; //set one to display message on login
        header("Location: /Semester2/website/sites/login.php");
        exit();
    }
}