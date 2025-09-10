<?php

declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

// Only allow logged-in admins to access this file
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] !== 1) {
    header("Location: /Sun_and_ground/index.php");
    exit();
}

// Check if an order_id was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];

    try {
        $query = "UPDATE orders SET is_sent = 1 WHERE id = :order_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();

        // Redirect back to the admin page with a success message
        header("Location: /Sun_and_ground/profileAdmin.php?status=success");
        exit();
        
    } catch (PDOException $e) {
        error_log("Failed to update order status: " . $e->getMessage());
        header("Location: /Sun_and_ground/profileAdmin.php?status=error");
        exit();
    }
} else {
    // If no order_id was submitted, redirect back to the admin page
    header("Location: /Sun_and_ground/profileAdmin.php");
    exit();
}