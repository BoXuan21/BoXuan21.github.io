<nav id="navbar">
    <div class="logo"><a href="../index.php"><img src="../pics/Logo.png" alt="Logo"></a></div>
    <ul class="nav-links">
        <li><a href="buyProducts.php">Buy</a></li>
        <li><a href="sellProducts.php">Sell</a></li>
        <li><a href="auction.php">Auction</a></li>
        <li><a href="support.php">Support</a></li>
    </ul>
    </ul>
    <ul class="auth-cart">
        <li><a href="cart.php">Cart</a></li>
        <?php if (!isset($_SESSION['user_id'])) { ?>
            <li class="dropdown">
                <a href="javascript:void(0)">Login/Register &#9662;</a>
                <div class="dropdown-content">
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            </li>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION['user_id'])) {
            $username = $_SESSION['user_name'] ?>
            <li class="dropdown">
                <a href="javascript:void(0)"><?php echo "$username" ?> &#9662;</a>
                <div class="dropdown-content">
                    <a href="profile.php">My account</a>
                    <a href="profileSells.php">My sells</a>
                    <a href="../form_logic/logout.php">Logout</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</nav>