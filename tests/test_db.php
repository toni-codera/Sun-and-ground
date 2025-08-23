<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters - ENSURE THESE MATCH YOUR dbh.inc.php
$host = 'localhost';
$dbname = 'sun_and_ground'; // Make sure this is EXACTLY 'sun_and_ground'
$dbusername = 'root';
$dbpassword = ''; // Your root password, usually empty for XAMPP/WAMP

try {
    // Attempt to establish PDO connection
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $dbusername,
        $dbpassword
    );

    // Set error mode to exception to catch PDO errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>Database Connection Test Results</h1>";
    echo "<p style='color: green; font-weight: bold;'>Successfully connected to the database: '" . htmlspecialchars($dbname) . "'</p>";

    // Attempt a very simple query to ensure the database is truly selected and accessible
    // This query just fetches the number 1, it doesn't interact with your 'users' table directly
    // but confirms general connectivity and database selection.
    $stmt = $pdo->query("SELECT 1"); // A common way to test
    if ($stmt) {
        $result = $stmt->fetchColumn();
        echo "<p style='color: green;'>Successfully executed a test query. Result: " . htmlspecialchars($result) . "</p>";

        // Now try a query that interacts with your 'users' table to confirm it exists and is accessible
        try {
            $stmt_users = $pdo->query("SELECT COUNT(*) FROM users");
            $user_count = $stmt_users->fetchColumn();
            echo "<p style='color: green;'>Successfully queried 'users' table. User count: " . htmlspecialchars($user_count) . "</p>";
        } catch (PDOException $e) {
            echo "<p style='color: red; font-weight: bold;'>Error querying 'users' table: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

    } else {
        echo "<p style='color: red; font-weight: bold;'>Failed to execute a simple test query.</p>";
    }


} catch (PDOException $e) {
    // Catch and display any connection errors
    echo "<p style='color: red; font-weight: bold;'>Connection or Query failed: " . htmlspecialchars($e->getMessage()) . "</p>";
    // Optionally, you can log the error to a file instead of displaying it on a live site
    // error_log("PDO Connection Error: " . $e->getMessage());
}

// Close the PDO connection
$pdo = null;

?>