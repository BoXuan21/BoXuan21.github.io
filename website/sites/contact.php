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
        </section> 
        <section id="sales">
        <p>Contact us</p>
        <!-- Add more sections here for Products, About Us, and Contact -->
    </section>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
    <script src="jscript/script.js"></script>
</body>
</html>
