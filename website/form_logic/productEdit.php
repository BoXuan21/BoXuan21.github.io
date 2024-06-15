<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben
?>
<!-- __________________________________________________________________EDIT PROFILE__________________________________________________________________ -->
<?php
// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';
if (!empty($_POST["submitProductChanges"])) {
    $productID = $_POST['submitProductChanges'];
    $curr_productName = $_SESSION["curr_productName"];
    $curr_productCategory = $_SESSION["curr_productCategory"];
    $curr_productDescription = $_SESSION["curr_productDescription"];
    $curr_productPrice = $_SESSION["curr_productPrice"];
    $new_productName = $_POST['product_name'];
    $new_productCategory = $_POST['product_category'];
    $new_productDescription = $_POST['product_description'];
    $new_productPrice = $_POST['product_price'];

    if (empty($new_productName) and empty($new_productPrice) and ($curr_productCategory == $new_productCategory) and empty($new_productDescription)) {
        echo "<script>location.href='../sites/buyProducts.php'</script>";
    } else {
        if ($curr_productName != $new_productName and $new_productName != "") {
            mysqli_query($con, "UPDATE `tbl_products` SET `productName` = '$new_productName' WHERE productID = '$productID'");
        }
        if ($curr_productPrice != $new_productPrice and $new_productPrice != "") {
            mysqli_query($con, "UPDATE `tbl_products` SET `productPrice` = '$new_productPrice' WHERE productID = '$productID'");
            mysqli_query($con, "UPDATE `tbl_products` SET `edited` = 1 WHERE productID = '$productID'");
        }
        if ($curr_productCategory != $new_productCategory) {
            mysqli_query($con, "UPDATE `tbl_products` SET `productCategory` = '$new_productCategory' WHERE productID = '$productID'");
        }
        if ($curr_productDescription != $new_productDescription and $new_productDescription != "") {
            mysqli_query($con, "UPDATE `tbl_products` SET `productDescription` = '$new_productDescription' WHERE productID = '$productID'");
        }
        if($_SESSION['user_name'] == "admin"){
            echo "<script>location.href='../sites/buyProducts.php'</script>";
        }else{
            echo "<script>location.href='../sites/profileSells.php'</script>";
        } 
    }
}