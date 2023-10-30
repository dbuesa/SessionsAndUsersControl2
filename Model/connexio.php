<?php
//David Buesa

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pt03_david_buesa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->query("set names utf8;");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
