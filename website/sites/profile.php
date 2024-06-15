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
    $userID = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    ?>
    <div class="imgcontainer">
        <img src="../pics/login_avatar.png" alt="Avatar" class="avatar" style="max-width: 250px">
    </div>
    <h2></h2>
    <hr style="border-color: white;">
    <table class="tableCenter">
        <section id = "profile">
        <tr>
            <th class="profilFontLeft">UserID:</th>
            <th class="profilFontRight"><?php echo "$userID" ?></th>
        </tr>
        <tr>
            <td class="profilFontLeft">Username:</td>
            <td class="profilFontRight"><?php echo "$username" ?></td>
        </tr>
        <tr>
            <td class="profilFontLeft">Email:</td>
            <td class="profilFontRight"><?php echo "$email" ?></td>
        </tr>
        <tr>
            <td class="profilFontLeft">Password:</td>
            <td>********</td>
        </tr>
        <td>
            <div class="editProfile">
                <a href="profileEdit.php">
                    <button class="editButton">Edit profile</button>
                </a>
            </div>
        </td>
        </tr>
    </table>
    <hr style="border-color: white;">
    </section>
</body>

</html>