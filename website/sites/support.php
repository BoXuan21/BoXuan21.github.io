<?php
if (!isset ($_SESSION)) {
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
        <section id="support">
            <h2>Contact Us</h2>
            <div class="support-options">
                <!-- Option 1: Forgot Password -->
                <div class="support-option">
                    <h3>Forgot Password</h3>
                    <p>Forgot your password? Click below to reset it.</p>
                    <a href="forgot_password.php" class="button">Reset Password</a>
                </div>
                <!-- Option 2: Chat Support -->
                <div class="support-option">
                    <h3>Chat Support</h3>
                    <p>Need immediate assistance? Chat with our support team.</p>
                    <a href="chat_support.php" class="button">Chat Now</a>
                </div>
                <!-- Option 3: Auction Support -->
                <div class="support-option">
                    <h3>Auction Support</h3>
                    <p>Questions about our auctions? Get in touch with our auction support team.</p>
                    <a href="auction_support.php" class="button">Contact Auction Support</a>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
    <script src="jscript/script.js"></script>
</body>
</html>
