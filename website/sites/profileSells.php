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

<?php 
include '../includes/header.php';

// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';
?>
<body>
    <h2>Your Sales:</h2>
    <?php
    $userID = $_SESSION['user_id'];
    // SQL-Abfrage, um Produkte aus der Datenbank abzurufen
    $sql = "SELECT * FROM tbl_products WHERE userID = '$userID'";
    $result = $con->query($sql);

    // Überprüfen, ob Produkte vorhanden sind
    if ($result->num_rows > 0) {
        // Produkte ausgeben
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-box'>"; // Changed class to 'product-box'
            echo "<h3>" . $row["productName"] . "</h3>";
            //echo "<p>Category: " . $row["productCategory"] . "</p>";
            //echo "<p>Description: " . $row["productDescription"] . "</p>";
            //echo "<p>Price: $" . $row["productPrice"] . "</p>";
            if ($row["edited"] == 1) {
                echo "<p class='adminChanged'>Price adjusted by Admin</p>";
            }
            echo "<img src='../uploads/pictures" . $row["filename"] . "' alt='Product Image'>";
            echo "<form method='post' action='productEdit.php'> <button type='submit' name='editProduct' value='$row[productID]'>Edit</button></form>";
            echo "</div>";
        }
    } else {
        echo "You have not listed any products yet.";
    }
    ?>
</body>

</html>