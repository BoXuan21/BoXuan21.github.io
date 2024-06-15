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

<?php 
include '../includes/header.php';
if(!isset($_SESSION['user_name'])){
    $_SESSION['error'] = 3;
    header("Location: register.php");
}
?>

<body>
    <main>
        <section id="sell">
            <h1>Sell Your Products</h1>
            <p>Have something you'd like to sell? List it here on SmartBuy and reach thousands of potential buyers!</p>
            <div class="sell-form">
            <form action="../form_logic/submit-product.php" method="post" enctype="multipart/form-data">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" required><br><br>
                    <label for="productCategory">Category:</label>
                    <select id="productCategory" name="productCategory">
                        <option value="electronics">Electronics</option>
                        <option value="cars">Cars</option>
                        <option value="food">Food</option>
                        <!-- Add more categories as needed -->
                    </select><br><br>
                    <label for="productDescription">Description:</label>
                    <textarea id="productDescription" name="productDescription" rows="4" cols="50" required></textarea><br><br>
                    <label for="productPrice">Price:</label>
                    <input type="number" id="productPrice" name="productPrice" required><br><br>
                    <label for="fileToUpload">Upload Image:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                    <button type="submit" class="submitButton" name="submitProductID" value=<?php echo $_SESSION['user_id'] ?>>upload</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
</body>
</html>
