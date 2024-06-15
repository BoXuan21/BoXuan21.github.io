<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); // Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); // Zusatzeinstellung: Error wird ausgegeben

// Create a database connection
include __DIR__ . '/../includes/dbaccess.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitProductID'])) {
    // Handle file upload
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $imageName = $_FILES["fileToUpload"]["name"];
        $target_dir = "../uploads/"; // Directory where the file will be saved
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            //resize uploaded file
            function fn_resize($image_resource_id, $width, $height) {
                $target_width = 960;
                $target_height = 540;
                $target_layer = imagecreatetruecolor($target_width, $target_height);
                imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
                return $target_layer;
            }

            if(is_array($_FILES)) {
                //echo $target_dir.$imageName;
                $source_properties = getimagesize($target_dir.$imageName);
                $image_type = $source_properties[2];
                if($image_type == IMAGETYPE_JPEG) {
                    $original_image = imagecreatefromjpeg($target_dir.$imageName);
                    $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                    imagejpeg($target_layer, $target_dir."pictures".$_FILES["fileToUpload"]["name"]);
                } elseif($image_type == IMAGETYPE_GIF) {
                    $original_image = imagecreatefromgif($target_dir.$imageName);
                    $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                    imagegif($target_layer, $target_dir."pictures".$_FILES["fileToUpload"]["name"]);
                } elseif($image_type == IMAGETYPE_PNG) {
                    $original_image = imagecreatefrompng($target_dir.$imageName);
                    $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                    imagepng($target_layer, $target_dir."pictures".$_FILES["fileToUpload"]["name"]);
                }
                unlink($target_dir.$imageName);
            }
            
            // File upload successful, now insert data into database
            $userID = $_SESSION['user_id'];
            $productName = $_POST['productName'];
            $productCategory = $_POST['productCategory'];
            $productDescription = $_POST['productDescription'];
            $productPrice = $_POST['productPrice'];
            $filename = basename($_FILES["fileToUpload"]["name"]);

            // Calculate auction end time based on selected duration
            $auctionDuration = $_POST['auctionDuration'];
            $auctionEndTime = date('Y-m-d H:i:s', strtotime("+ $auctionDuration days"));

            // SQL statement to insert data into database
            $sql = "INSERT INTO tbl_auction (userID, productName, productCategory, productDescription, productPrice, filename, auctionEndTime, auctionDuration)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Prepare and execute the SQL statement
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssssss", $userID, $productName, $productCategory, $productDescription, $productPrice, $filename, $auctionEndTime, $auctionDuration);
            $stmt->execute();

            header("Location: ../sites/buyProducts.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    // If form is not submitted via POST method or if 'submitProductID' is not set, redirect back to the form page
    header("Location: ../sellproduct.php");
    exit();
}

// Close the database connection
$con->close();
?>
