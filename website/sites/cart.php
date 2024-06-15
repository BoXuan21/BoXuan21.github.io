<?php
session_start();
include __DIR__ . '/../includes/dbaccess.php';
include '../includes/header.php';
include '../includes/navbar.php';

$cart = $_SESSION['cart'] ?? [];
$productIDs = array_column($cart, 'productID');
$isAuctionedFlags = array_column($cart, 'isAuctioned');

if (!empty($productIDs)) {
    $productIDsStr = implode(',', $productIDs);

    $sql_products = "SELECT * FROM tbl_products WHERE productID IN ($productIDsStr)";
    $sql_auctioned = "SELECT * FROM tbl_auction WHERE productID IN ($productIDsStr)";

    $result_products = $con->query($sql_products);
    $result_auctioned = $con->query($sql_auctioned);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <main>
        <section id="buy">
            <div class="cart-heading-container">
                <h2 class="cart-heading">
                    <img src="../pics/cart.png" alt="Cart" style="width: 50px; height: 50px;">
                    Cart
                </h2>
            </div>
            <?php if (!empty($productIDs)): ?>
                <div>
                    <h3>Buy Products</h3>
                    <?php while ($row = $result_products->fetch_assoc()): ?>
                        <div class='product-box'>
                            <h3><?php echo $row["productName"]; ?></h3>
                            <p>Category: <?php echo $row["productCategory"]; ?></p>
                            <p>Description: <?php echo $row["productDescription"]; ?></p>
                            <p>Price: $<?php echo $row["productPrice"]; ?></p>
                            <img src='../uploads/pictures<?php echo $row["filename"]; ?>' alt='Product Image'>
                            <button type="button" class='remove-from-cart' data-product-id='<?php echo $row["productID"] ?>'
                                data-is-auctioned='1'>Remove from cart</button>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div>
                    <h3>Auctioned Products</h3>
                    <?php while ($row_auctioned = $result_auctioned->fetch_assoc()): ?>
                        <div class='product-box'>
                            <h3><?php echo $row_auctioned["productName"]; ?></h3>
                            <p>Category: <?php echo $row_auctioned["productCategory"]; ?></p>
                            <p>Description: <?php echo $row_auctioned["productDescription"]; ?></p>
                            <p>Price: $<?php echo $row_auctioned["productPrice"]; ?></p>
                            <p>Auction Duration: <?php echo $row_auctioned["auctionDuration"]; ?> days</p>
                            <img src='../uploads/pictures<?php echo $row_auctioned["filename"]; ?>' alt='Product Image'>
                            <button type="button" class='remove-from-cart' data-product-id='<?php echo $row_auctioned["productID"] ?>'
                                data-is-auctioned='1'>Remove from cart</button>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Remove from Cart functionality
        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productID = this.getAttribute('data-product-id');
                const isAuctioned = this.getAttribute('data-is-auctioned');

                fetch('../form_logic/carthandler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ productID: productID, isAuctioned: isAuctioned, action: 'remove' })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Product removed from cart!');
                            location.reload();
                        } else {
                            alert('Error removing product from cart.');
                        }
                    });
            });
        });
    </script>

</body>

</html>