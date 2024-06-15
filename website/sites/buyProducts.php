<?php
// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';

// Check if there is an active session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 'On'); // Display errors

// Include navbar
include '../includes/navbar.php';

// Get the search query and sort order if they exist
$search_query = isset($_POST['search']) ? $_POST['search'] : '';
$sort_order = isset($_POST['sort_order']) ? $_POST['sort_order'] : '';

// Define sorting options
$sorting_options = [
    '' => 'Default',
    'asc' => 'Price: Low to High',
    'desc' => 'Price: High to Low'
];
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php' ?>
<head>
    <style>
        /* CSS for the search and sort form */
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"],
        .search-form select {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 20px; /* Increased border-radius for rounder corners */
        }
        .search-form button {
            padding: 10px 20px;
            background-color: #007BFF; /* Blue button color */
            color: #fff;
            border: none;
            border-radius: 20px; /* Increased border-radius for rounder corners */
            cursor: pointer;
        }
        .search-form button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <main>
    <div class="product-container">
        <section id="buy">
            <h2>Current Sales</h2>
            <!-- Search form -->
            <form method="post" action="" class="search-form">
                <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search_query); ?>">
                <select name="sort_order">
                    <?php
                    foreach ($sorting_options as $value => $label) {
                        echo '<option value="' . $value . '" ' . ($sort_order === $value ? 'selected' : '') . '>' . $label . '</option>';
                    }
                    ?>
                </select>
                <button type="submit">Search</button>
            </form>
            <?php
            // SQL query to fetch products from the database with sorting
            $sql = "SELECT * FROM tbl_products WHERE productName LIKE ?";
            if ($sort_order === 'asc') {
                $sql .= " ORDER BY productPrice ASC";
            } elseif ($sort_order === 'desc') {
                $sql .= " ORDER BY productPrice DESC";
            }
            $stmt = $con->prepare($sql);
            $search_param = "%$search_query%";
            $stmt->bind_param("s", $search_param);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if products are available
            if ($result != NULL && $result->num_rows > 0) {
                // Display products
                while($row = $result->fetch_assoc()) {
                    echo '<a href="./product.php?id=' . $row["productID"] . '">';
                    echo "<div class='product-box'>"; // Changed class to 'product-box'
                    echo '<h3>' . $row["productName"] . '</h3>';
                    if($row["edited"] == 1){
                        echo "<p class='adminChanged'>Price verified by Admin</p>";
                    }
                    echo "<img src='../uploads/pictures" . $row["filename"] . "' alt='Product Image'>";
                    echo "<button type='button'>Buy</button>"; // Add "Buy" button
                    echo "<button type='button' class='add-to-cart' data-product-id='" . $row["productID"] . "' data-is-auctioned='1'>Add to Cart</button>"; // Add "Add to Cart" button
                    if($_SESSION['user_name'] == "admin"){
                        echo "<form method='post' action='productEdit.php'> <button type='submit' name='editProduct' value='$row[productID]'>Edit</button></form>";
                        //echo "<a href='productEdit.php'><button name='editProduct' value='$row[productID]'>Edit</button></a>"; // Add "Add to Cart" button
                    }
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "No products available.";
            }
            ?>
        </section>
        <section id="auctioned">
            <h2>Auctioned Items</h2>
            <?php
            // SQL query to fetch auctioned products from the database
            $sql_auctioned = "SELECT * FROM tbl_auction";
            $result_auctioned = $con->query($sql_auctioned);

            // Check if auctioned products are available
            if ($result_auctioned->num_rows > 0) {
                // Display auctioned products
                while($row_auctioned = $result_auctioned->fetch_assoc()) {
                    $durationInSeconds = $row_auctioned["auctionDuration"] * 24 * 60 * 60; // Convert duration from days to seconds
                    $endTime = time() + $durationInSeconds; // Calculate end time based on current time and duration
                    echo "<div class='product-box'>";
                    echo "<h3>" . $row_auctioned["productName"] . "</h3>";
                    echo "<p>Category: " . $row_auctioned["productCategory"] . "</p>";
                    echo "<p>Description: " . $row_auctioned["productDescription"] . "</p>";
                    echo "<p>Price: $" . $row_auctioned["productPrice"] . "</p>";
                    echo "<p>Auction Duration: " . $row_auctioned["auctionDuration"] . " days</p>";
                    echo "<p>Time left: <span class='countdown' data-endtime='" . $endTime . "'></span></p>"; // Move this above the image
                    echo "<img src='../uploads/pictures" . $row_auctioned["filename"] . "' alt='Product Image'>";
                    echo '<a href="./bidProduct.php?id=' . $row_auctioned['productID'] . '">';
                    echo "<button class='Bid'>Place bid</button></a>";
                    echo "<button class='add-to-cart' data-product-id='" . $row_auctioned["productID"] . "' data-is-auctioned='1'>Save in cart</button>";
                    echo "</div>";
                }
            } else {
                echo "No auctioned items available.";
            }
            ?>
        </section>   </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add to Cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
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
