<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; 
$password = ""; // Falls du kein Passwort hast, lass dies leer
$database = "product"; 

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $database);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
