<?php

declare(strict_types=1);

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

// is the user logged in
if (!isset($_SESSION["user_id"])) {
    http_response_code(401); 
    echo json_encode(['error' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION["user_id"];

try {
    // fetch all orders for the user
    $query = "
        SELECT
            o.id AS order_id,
            o.order_date,
            o.is_sent,
            oi.quantity,
            pv.weight_grams,
            pv.price_cents,
            p.name AS product_name,
            p.image_path
        FROM orders AS o
        INNER JOIN order_items AS oi ON o.id = oi.order_id
        INNER JOIN product_variations AS pv ON oi.product_variation_id = pv.id
        INNER JOIN products AS p ON pv.product_id = p.id
        WHERE o.user_id = :user_id
        ORDER BY o.order_date DESC;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // group items by order id
    $grouped_orders = [];
    foreach ($orders as $item) {
        $order_id = $item['order_id'];
        if (!isset($grouped_orders[$order_id])) {
            $grouped_orders[$order_id] = [
                'order_id' => $order_id,
                'order_date' => $item['order_date'],
                'is_sent' => (bool)$item['is_sent'],
                'items' => []
            ];
        }
        $grouped_orders[$order_id]['items'][] = [
            'product_name' => $item['product_name'],
            'weight_grams' => $item['weight_grams'],
            'quantity' => $item['quantity'],
            'price_cents' => $item['price_cents'],
            'image_path' => $item['image_path']
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode(array_values($grouped_orders));

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Грешка в базата данни: ' . $e->getMessage()]);
}