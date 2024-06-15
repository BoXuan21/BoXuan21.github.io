<?php
if (!isset ($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben

include 'includes/indexnavbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/indexheader.php' ?>

<body>

    <main>
        <section id="home">
            <?php if(isset($_SESSION["user_id"])){ ?>
                    <h2>Hello there, <?php echo $_SESSION["user_name"] ?>!</h2> <?php
                }
            ?>
            
            <h1>Welcome to Smart Buy</h1>
            <h2>The only store you need!</h2>
            <div class="action-buttons">
                <button onclick="location.href='sites/buyProducts.php'"> Buy</button>
                <button onclick="location.href='sites/sellProducts.php'">Sell</button>
                <button onclick="location.href='sites/buyProducts.php'">Auction</button>

            </div>
        </section>
        <section id="sales">
            <!-- Add more sections here for Products, About Us, and Contact -->
        </section>
        <!-- Slideshow container -->
        <div class="slideshow-container">
            <!-- Slide 1 with two images -->
            <div class="mySlides fade">
                <a href="sites/link-to-product1.php"><img src="pics/img1.png" alt="Product 1"></a>
                <a href="sites/link-to-product2.php"><img src="pics/img2.png" alt="Product 2"></a>
            </div>
            <!-- Slide 2 with two images -->
            <div class="mySlides fade">
                <a href="sites/link-to-product3.php"><img src="pics/img3.png" alt="Product 3"></a>
                <a href="sites/link-to-product4.php"><img src="pics/img4.png" alt="Product 4"></a>
            </div>
            <!-- More slides as needed -->
            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>


        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
    <script src="jscript/script.js"></script>

</body>

</html>