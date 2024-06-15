<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben

include '../includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body>
    <main>
        <?php  //tell user that their account details are already in use
        if (isset($_SESSION['accountCreated']) && $_SESSION['accountCreated'] == true) { ?>
            <div class="form-container success">
                <?php
                echo "Thank you for registration! You can now log in!";
                $_SESSION['accountCreated'] = false;
                ?>
            </div>
            <?php
        }
        //username not found
        if (isset($_SESSION['userNotFound']) && $_SESSION['userNotFound'] == true) { ?>
            <div class="form-container error">
                <?php
                echo "No user with this username found!";
                $_SESSION['userNotFound'] = false;
                ?>
            </div>
            <?php
        }
        //password incorrect
        if (isset($_SESSION['passwordIncorrect']) && $_SESSION['passwordIncorrect'] == true) { ?>
            <div class="form-container error">
                <?php
                echo "Incorrect password!";
                $_SESSION['passwordIncorrect'] = false;
                ?>
            </div>
            <?php
        }
        ?>
        <div class="form-container">
            <h2>Login</h2>
            <form action="../form_logic/login.php" method="post"> <!-- Point the form to your PHP login script -->
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" name="Login" value="Login">
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </div>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
</body>

</html>