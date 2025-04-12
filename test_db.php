<?php

// Create a new database connection
$db = new mysqli('localhost', 'root', '', 'adet');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

echo "Database connection successful!";

// Check if tables exist
$tables = ['users', 'resident_profiles'];
foreach ($tables as $table) {
    $result = $db->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        echo "<br>Table '$table' exists.";
    } else {
        echo "<br>Table '$table' does not exist.";
    }
}

// Close connection
$db->close(); 