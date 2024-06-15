<?php
// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';

// Check if there is an active session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 'On'); // Display errors

include '../includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php
// Include header
include '../includes/header.php';
?>


<body>
    <?php
    // Create a database connection
    include __DIR__ . '/../includes/dbaccess.php';

    //isset($_GET["data"]);
    $productID = $_GET["id"];
    $sql = "SELECT * FROM tbl_auction WHERE productID = '$productID'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $productbidder = $row["biduserID"];
    $productname = $row["productName"];
    $_SESSION["curr_productName"] = $productname;
    $productCategory = $row["productCategory"];
    $productDescription = $row["productDescription"];
    $productPrice = $row["productPrice"];
    $_SESSION["curr_productPrice"] = $productPrice;

    ?>
    <div class="imgcontainer">
        <?php echo "<img src='../uploads/pictures" . $row["filename"] . "' alt='Product Image' class='avatar' style='max-width: 250px'>"; ?>
    </div>
    <h2 style="text-align: center">Product details:</h2>
    <hr style="border-color: white;">
    <table class="tableCenter">
        <tr>
            <th class="profilFontLeft">Product name:</th>
            <th class="profilFontRight"><?php echo "$productname" ?></th>
        </tr>
        <tr>
            <td class="profilFontLeft">Product category:</td>
            <td class="profilFontRight" type="text" name="product_description"><?php echo "$productCategory" ?></td>
            <!--<td><input class="profilFontRight" type="text" placeholder="<?php //echo "$productCategory" ?>" name="product_category"></td>-->
        </tr>
        <tr>
            <td class="profilFontLeft">Product description:</td>
            <td class="profilFontRight" type="text" name="product_description"><?php echo "$productDescription" ?>
            </td>
            <!--<td><input class="profilFontRight" type="text" placeholder="<?php //echo "$productDescription" ?>" name="product_description"></td>-->
        </tr>
        <tr>
            <td class="profilFontLeft">Current highest bid:</td>
            <td class="profilFontRight halfLength"><?php echo "$productPrice" ?>$ by 
            <?php 
            if($productbidder == 0){
                echo "owner";
            }else{
                $sql = "SELECT * FROM tbl_users WHERE user_id = '$productbidder'";
                $result = $con->query($sql);
                $row = $result->fetch_assoc();
                echo $row["user_name"];
            } ?>
            </td>
        </tr>
        <tr>
            <td class="profilFontLeft">Time left:</td>
            <td class="profilFontRight halfLength"><span class='countdown' data-endtime='" . $endTime . "'></span></td>
        </tr>
        <tr>
            <td>
                <a href="./buyProducts.php">
                    <button class="editButton" type="button" name="back">
                        Go back
                    </button>
                </a>
            </td>
            <td>
                <form action="../form_logic/bidhandler.php" method="post">
                    <?php //newBid is 102% of original price
                    $newBid = round($productPrice + ($productPrice / 50)); ?>
                    <input class="bidInput" type="number" min="<?php echo "$newBid" ?>" value="<?php echo "$newBid" ?>"
                        name="newBid">
                    <button class="editButton" type="submit" name="placeBid" value="<?php echo "$productID" ?>">
                        Place bid
                    </button>
                </form>
            </td>
        </tr>
    </table>


    <hr style="border-color: white;">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Add to Cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const productID = this.getAttribute('data-product-id');
                    const isAuctioned = this.getAttribute('data-is-auctioned');

                    fetch('../form_logic/carthandler.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ productID: productID, isAuctioned: isAuctioned, action: 'add' })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Product added to cart!');
                            } else {
                                alert('Error adding product to cart.');
                            }
                        });
                });
            });

            // Auction Countdown functionality
            const updateCountdown = () => {
                document.querySelectorAll('.countdown').forEach(timer => {
                    const endTime = parseInt(timer.getAttribute('data-endtime'), 10) * 1000; // Convert to milliseconds
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance > 0) {
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        timer.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    } else {
                        timer.textContent = 'Auction ended';
                    }
                });
            };

            // Update countdown every second
            setInterval(updateCountdown, 1000);
            updateCountdown();
        });
    </script>
</body>


</html>