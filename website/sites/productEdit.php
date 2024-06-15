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
    <?php
    // Create a database connection
    include __DIR__ . '/../includes/dbaccess.php';

    $productID = $_POST['editProduct'];
    $sql = "SELECT * FROM tbl_products WHERE productID = '$productID'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
    $productname = $row["productName"];
    $productCategory = $row["productCategory"];
    $productDescription = $row["productDescription"];
    $productPrice = $row["productPrice"];
    $_SESSION["curr_productName"] = $productname;
    $_SESSION["curr_productCategory"] = $productCategory;
    $_SESSION["curr_productDescription"] = $productDescription;
    $_SESSION["curr_productPrice"] = $productPrice;

    ?>
    <div class="imgcontainer">
        <?php echo "<img src='../uploads/pictures" . $row["filename"] . "' alt='Product Image' class='avatar' style='max-width: 250px'>"; ?>
    </div>
    <h2 style="text-align: center">Edit the product here</h2>
    <hr style="border-color: white;">
    <form method="post" action="../form_logic/productEdit.php">
        <table class="tableCenter">
            <tr>
                <th class="profilFontLeft">ProductID:</th>
                <th class="profilFontRight"><?php echo "$productID" ?></th>
            </tr>
            <tr>
                <td class="profilFontLeft">Product name:</td>
                <td><input class="profilFontRight" type="text" placeholder="<?php echo "$productname" ?>" name="product_name">
                </td>
            </tr>
            <tr>
                <td class="profilFontLeft">Product category:</td>
                <!--<td><p class="profilFontRight" type="text" name="product_description"><?php //echo "$productCategory" ?></p></td>-->
                <td><select class="profilFontRight" name="product_category">
                <?php
                    if ($productCategory == "cars") { ?>
                        <option value="cars">Cars</option>
                        <option value="electronics">Electronics</option>
                        <option value="food">Food</option>
                    <?php } else if ($productCategory == "electronics") { ?>
                            <option value="electronics">Electronics</option>
                            <option value="cars">Cars</option>
                            <option value="food">Food</option>
                    <?php } else if ($productCategory == "food") { ?>
                                <option value="food">Food</option>
                                <option value="electronics">Electronics</option>
                                <option value="cars">Cars</option>
                    <?php }
                    ?>
                    </select>
                    </td>
            </tr>
            <tr>
                <td class="profilFontLeft">Product description:</td>
                <!--<td><p class="profilFontRight" type="text" name="product_description"><?php echo "$productDescription" ?></p></td>-->
                <td><input class="profilFontRight" type="text" placeholder="<?php echo "$productDescription" ?>" name="product_description"></td>
            </tr>
            <tr>
                <td class="profilFontLeft">Product price:</td>
                <td><input class="profilFontRight halfLength" style="color: black" type="text"placeholder="$<?php echo "$productPrice" ?>" name="product_price"></td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button class="editButton" type="submit" name="submitProductChanges" value=<?php echo "$productID" ?>>
                        Save changes
                    </button>
                </td>
            </tr>
        </table>
    </form>

    <hr style="border-color: white;">
</body>

</html>