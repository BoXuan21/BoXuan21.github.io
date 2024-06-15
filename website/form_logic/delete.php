<?php
include __DIR__ . '/../includes/dbaccess.php'; // Include database connection

// Check if product ID is received through POST
if(isset($_POST['deleteProduct']) && isset($_POST['productID'])) {
    $productID = $_POST['productID'];

    // Prepare and execute SQL DELETE query
    $sql = "DELETE FROM tbl_auction WHERE productID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $productID);
    if($stmt->execute()) {
        // Deletion successful
        echo "Product deleted successfully.";
    } else {
        // Deletion failed
        echo "Error deleting product: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $con->close();
}
?>
