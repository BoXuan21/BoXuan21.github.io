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
        if (isset($_SESSION['error']) && $_SESSION['error'] == 2) { ?>
            <div class="form-container error">
                <?php
                echo "username or email is already being used!";
                $_SESSION['error'] = 0;
                ?>
            </div>
            <?php
        }
        elseif (isset($_SESSION['error']) && $_SESSION['error'] == 3) { ?>
            <div class="form-container error">
                <?php
                echo "Please create an account or login before selling something!";
                $_SESSION['error'] = 0;
                ?>
            </div>
            <?php
        }
        ?>

        <div class="form-container">
            <h2>Register</h2>
            <form action="../form_logic/register.php" method="post">
                <!-- Point the form to your PHP registration script -->
                <label for="newUsername">Username:</label>
                <input type="text" id="newUsername" name="newUsername" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="newPassword">Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>

                <input type="submit" name="Register" value="Register">
            </form>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
</body>

</html>