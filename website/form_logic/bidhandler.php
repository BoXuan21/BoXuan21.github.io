<!-- __________________________________________________________________PLACE BID__________________________________________________________________ -->
<?php
// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';

// Check if there is an active session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 'On'); // Display errors

    $productID = $_POST['placeBid'];
    $newPrice = $_POST['newBid'];
    $userID = $_SESSION['user_id'];
    //echo "<h1>$productID</h1>";biduserID = '$userID', 
        // Prepare the SQL statement
        $stmt = $con->prepare("UPDATE tbl_auction SET productPrice = ?, biduserID = ? WHERE productID = ?");
        $stmt->bind_param("iii", $newPrice, $userID, $productID); 

        // Execute the statement
        if ($stmt->execute()) {
            echo "Bid placed successfully!";
        } else {
            echo "Error placing bid: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
//echo "$productID, $newPrice, $userID";
header("Location: ../sites/bidProduct.php?id=$productID");
?>