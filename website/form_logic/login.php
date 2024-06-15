<?php
// Start a PHP session
session_start();

// Check if the form is submitted
if (!empty ($_POST["Login"])) {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Create a database connection
        include __DIR__ . '/../includes/dbaccess.php';

        // Check if the username or email already exists in the database
        $result = mysqli_query($con, "SELECT * FROM `tbl_users` WHERE user_name = '$username'");
        //var_dump($result);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen

        if ($result->num_rows == 1) { //Username found
            //$hashed_passwort = password_hash("1234", PASSWORD_DEFAULT);
            if($password == $row["user_password"]){
                //password is correct
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['user_name'] = $row["user_name"];
                $_SESSION['user_email'] = $row["user_email"];
                echo "<script>location.href='../index.php'</script>";
            }
            else{ //password incorrect
                $_SESSION['passwordIncorrect'] = true;
                echo $password;
                echo "<br>";
                echo $row["user_password"];
                echo "<br>";
                var_dump(password_verify($password, $row["user_password"]));
                echo "<script>location.href='../sites/login.php'</script>";
            }
        } else { //username not found
            $_SESSION['userNotFound'] = true;
            echo "<script>location.href='../sites/login.php'</script>";
        }

    
}
