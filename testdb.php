<?php
$mysqli = new mysqli("localhost", "root", "mysqldbs", "makara_smm");

if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
}
echo "✅ Database connection successful!";
?>
