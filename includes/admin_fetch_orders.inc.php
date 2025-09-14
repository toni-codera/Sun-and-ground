<?php

declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

// only allow admin access to this page
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] !== 1) {
    http_response_code(403);
    echo "Forbidden: You do not have permission to view this page.";
    exit();
}

function admin_fetch_orders() {
    global $pdo; 
    try {
        $query = "
            SELECT 
                o.id AS order_id, 
                o.order_date, 
                o.is_sent,
                u.id AS user_id,
                u.firstname,
                u.lastname,
                u.email,
                u.home_address,
                u.phone,
                oi.quantity,
                pv.weight_grams,
                pv.price_cents,
                p.name AS product_name
            FROM orders AS o
            JOIN users AS u ON o.user_id = u.id
            JOIN order_items AS oi ON o.id = oi.order_id
            JOIN product_variations AS pv ON oi.product_variation_id = pv.id
            JOIN products AS p ON pv.product_id = p.id
            ORDER BY o.order_date DESC;
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $all_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $grouped_orders = [];
        foreach ($all_orders as $item) {
            $order_id = $item['order_id'];
            if (!isset($grouped_orders[$order_id])) {
                $grouped_orders[$order_id] = [
                    'order_id' => $order_id,
                    'order_date' => $item['order_date'],
                    'is_sent' => (bool)$item['is_sent'],
                    'user_info' => [
                        'firstname' => $item['firstname'],
                        'lastname' => $item['lastname'],
                        'email' => $item['email'],
                        'home_address' => $item['home_address'],
                        'phone' => $item['phone']
                    ],
                    'items' => []
                ];
            }
            $grouped_orders[$order_id]['items'][] = [
                'product_name' => $item['product_name'],
                'weight_grams' => $item['weight_grams'],
                'quantity' => $item['quantity'],
                'price_cents' => $item['price_cents']
            ];
        }
        return $grouped_orders;

    } catch (PDOException $e) {
        error_log("Failed to fetch all orders: " . $e->getMessage());
        return [];
    }
}