<?php

declare(strict_types=1);

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

//is the user logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: /Sun_and_ground/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

try {
    // start of the database transaction
    $pdo->beginTransaction();
    // getting the user's cart_id
    $query = "SELECT id FROM carts WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $cart_id = $stmt->fetchColumn();

    if (!$cart_id) {
        echo "<script>alert('Количката е празна'); window.location.href='/Sun_and_ground/index.php';</script>";
        exit();
    }
    // fetch all items from the user's cart
    $query = "SELECT * FROM cart_items WHERE cart_id = :cart_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":cart_id", $cart_id);
    $stmt->execute();
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart_items)) {
        echo "<script>alert('Количката е празна'); window.location.href='/Sun_and_ground/index.php';</script>";
        exit();
    }
    // create a new order in the orders table
    $query = "INSERT INTO orders (user_id) VALUES (:user_id);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    // get the ID of the newly created order
    $order_id = $pdo->lastInsertId();
    // move each item from the cart to the 'order_items' table
    $query = "INSERT INTO order_items (order_id, product_variation_id, quantity) VALUES (:order_id, :product_variation_id, :quantity);";
    $stmt = $pdo->prepare($query);

    foreach ($cart_items as $item) {
        $stmt->bindParam(":order_id", $order_id);
        $stmt->bindParam(":product_variation_id", $item['product_variations_id']);
        $stmt->bindParam(":quantity", $item['quantity']);
        $stmt->execute();
    }
    // delete all items from the user's cart
    $query = "DELETE FROM cart_items WHERE cart_id = :cart_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":cart_id", $cart_id);
    $stmt->execute();


    $pdo->commit();
    header("Location: /Sun_and_ground/index.php");
    exit();

} catch (PDOException $e) {
    // roll back the transaction
    $pdo->rollBack();
    error_log("Order processing failed: " . $e->getMessage());
    echo "Възникна грешка при обработката на вашата поръчка. Опитайте отново.";
}