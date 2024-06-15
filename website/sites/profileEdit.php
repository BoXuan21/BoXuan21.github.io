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
    <h2 style="text-align: center">Edit Your Profile data here</h2>
    <hr style="border-color: white;">
    <form method="post" action="profileEdit.php">
        <table class="tableCenter">
            <tr>
                <th class="profilFontLeft">UserID:</th>
                <th class="profilFontRight"><?php echo "$userID" ?></th>
            </tr>
            <tr>
                <td class="profilFontLeft">Username:</td>
                <td><input class="profilFontRight" type="text" placeholder="<?php echo "$username" ?>" name="user_name">
                </td>
            </tr>
            <tr>
                <td class="profilFontLeft">Email:</td>
                <td><input class="profilFontRight" type="text" placeholder="<?php echo "$email" ?>" name="user_email">
                </td>
            </tr>
            <tr>
                <td class="profilFontLeft">New password:</td>
                <td><input class="profilFontRight" type="text" placeholder="New password" name="user_newPasswort"></td>
            </tr>
            <tr>
                <td class="profilFontLeft">Current password:</td>
                <td><input class="profilFontRight halfLength" style="color: black" type="text"
                        placeholder="Current password" name="user_oldPasswort"></td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button class="editButton" type="submit" name="submitChanges" value="abgeschickt">
                        Save changes
                    </button>

                    <button class="deleteAccBtn" name="deleteConfirm" value=<?php echo $_SESSION['user_id'] ?>>
                        Delete Account
                    </button>
                </td>
            </tr>
        </table>
    </form>

    <hr style="border-color: white;">
</body>
<!-- __________________________________________________________________DELETE ACCOUNT__________________________________________________________________ -->
<?php
if (!empty($_POST["deleteConfirm"])) {
    $currentID = $_POST['deleteConfirm'];
    echo $currentID;
    $con = mysqli_connect("localhost", "root", ""); //Verbindung mit der Datenbank
    mysqli_select_db($con, "shoppingdb");
    //Delete products uploaded by this account
    //mysqli_query($con, "DELETE FROM `tbl_products` WHERE user_id = $currentID");
    //Delete the account
    mysqli_query($con, "DELETE FROM `tbl_user` WHERE user_id = $currentID");
    include __DIR__ . '../form_logic/logout.php';
}
?>
<!-- __________________________________________________________________EDIT PROFILE__________________________________________________________________ -->
<?php
if (!empty($_POST["submitChanges"])) {
    $username = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    $change_username = $_POST['user_name'];
    $change_email = $_POST['user_email'];
    $change_newPasswort = $_POST["user_newPasswort"];
    $change_oldPasswort = $_POST["user_oldPasswort"];

    // Create a database connection
    include __DIR__ . '/../includes/dbaccess.php';

    // Check if the username or email already exists in the database
    $result = mysqli_query($con, "SELECT * FROM `tbl_users` WHERE user_name = '$username'");
    //var_dump($result);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
    //Der User gibt keine Änderung an
    if (empty($change_username) and empty($change_email) and empty($change_newPasswort) and empty($change_oldPasswort)) {
        echo "<script>location.href='profile.php'</script>";
    } else {
        if ($change_anrede != $Sess_anrede) {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_anrede` = '$change_anrede' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['anrede'] = $change_anrede;
        }
        if ($change_vorname != $Sess_vorname and $change_vorname != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_vorname` = '$change_vorname' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['vorname'] = $change_vorname;
        }
        if ($change_nachname != $Sess_nachname and $change_nachname != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_nachname` = '$change_nachname' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['nachname'] = $change_nachname;
        }
        if ($change_email != $Sess_email and $change_email != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_email` = '$change_email' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['email'] = $change_email;
        }
        if ($change_benutzername != $Sess_benutzername and $change_benutzername != "") {
            //Checken ob Benutzername nicht schon vergeben ist
            $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$change_benutzername'");
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
            $count_benutzername = mysqli_num_rows($result); //Zählt Reihen in denen Username und Passwort vorkommen ( 0 oder 1)
            if ($count_benutzername == 1) { //Benutzername ist vergeben ?>
                <h1>Der gewünschte Benutzername ist leider bereits vergeben!</h1>
            <?php } else {
                mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_benutzername` = '$change_benutzername' WHERE user_benutzername = '$Sess_benutzername'");
                $_SESSION['username'] = $change_benutzername;
                $Sess_benutzername = $_SESSION['username']; //Sess_benutzername muss aktualisiert werden damit Passwortänderungen funktionieren
            }
        }
        if ($change_newPasswort != $Sess_passwort and $change_newPasswort != "") {
            if (password_verify($change_oldPasswort, $Sess_passwort)) {
                $change_newPasswort_hashed = password_hash($change_newPasswort, PASSWORD_DEFAULT);
                mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_passwort` = '$change_newPasswort_hashed' WHERE user_benutzername = '$Sess_benutzername'");
                $_SESSION['passwort'] = $change_newPasswort_hashed;

            } else { ?>
                <h1>Das aktuelle Passwort wurde falsch eingegeben. Bitte versuchen Sie es nochmal.</h1>
            <?php }
        }
        echo "<script>location.href='index.php?menu=profil'</script>";
    }
}
?>

</html>