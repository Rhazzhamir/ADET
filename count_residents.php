<?php

// Create a new database connection
$db = new mysqli('localhost', 'root', '', 'adet');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Query to count total residents
$result = $db->query("SELECT COUNT(*) as total FROM residents");
$row = $result->fetch_assoc();

echo "Total number of residents: " . $row['total'];

// Close connection
$db->close(); 