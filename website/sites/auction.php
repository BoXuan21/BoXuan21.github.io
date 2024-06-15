<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); // Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); // Zusatzeinstellung: Error wird ausgegeben

include '../includes/navbar.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_name'])) {
    $_SESSION['error'] = 3;
    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php 
include '../includes/header.php';
?>

<body>
    <main>
        <section id="sell">
            <h1>Dont know the Price?</h1>
            <p>Place an auction and see what your Product is worth</p>
            <div class="sell-form">
                <form action="../form_logic/submit-auction.php" method="post" enctype="multipart/form-data">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" required><br><br>
                    <label for="productCategory">Category:</label>
                    <select id="productCategory" name="productCategory">
                        <option value="electronics">Electronics</option>
                        <option value="cars">Cars</option>
                        <!-- Add more categories as needed -->
                    </select><br><br>
                    <label for="productDescription">Description:</label>
                    <textarea id="productDescription" name="productDescription" rows="4" cols="50" required></textarea><br><br>
                    <label for="productPrice">Minimum Price (in euros):</label>
                    <input type="number" id="productPrice" name="productPrice" value="1" min="1" required><br><br>
                    <label for="auctionDuration">Auction Duration:</label>
                    <label for="auctionDuration">Auction Duration:</label>
                    <select id="auctionDuration" name="auctionDuration">
                    <option value="7">7 days</option>
                    <option value="14">14 days</option>
                    <option value="21" selected>21 days</option>
                    <option value="28">28 days</option>
                    <option value="31">31 days</option>
                </select><br><br>
                    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                    <button type="submit" class="submitButton" name="submitProductID" value="<?php echo $_SESSION['user_id'] ?>">Upload</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
</body>
</html>
