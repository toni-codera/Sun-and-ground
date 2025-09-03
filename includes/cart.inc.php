<?php
declare(strict_types = 1);

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

// This is the critical block that prevents the error
if (!isset($_SESSION["user_id"])) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        http_response_code(401);
        echo json_encode(['error' => 'User not authenticated.']);
        die();
    } else {
        header("Location: ../login.php");
        die();
    }
}
$user_id = $_SESSION["user_id"];

// All database-related functions
function get_cart_items(PDO $pdo, int $user_id): array
{
    $query = "SELECT 
                ci.id,
                ci.quantity, 
                p.name AS product_name,
                p.image_path,
                pv.weight_grams, 
                pv.price_cents
              FROM cart_items ci
              JOIN carts c ON ci.cart_id = c.id
              JOIN product_variations pv ON ci.product_variations_id = pv.id
              JOIN products p ON pv.product_id = p.id
              WHERE c.user_id = :user_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_to_cart_db(PDO $pdo, int $cart_id, int $product_variation_id, int $quantity): bool
{
    $query = "INSERT INTO cart_items (cart_id, product_variations_id, quantity) VALUES (:cart_id, :product_variations_id, :quantity)
              ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':product_variations_id', $product_variation_id);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
}

function update_cart_quantity_db(PDO $pdo, int $cart_item_id, int $cart_id, int $new_quantity): bool
{
    $query = "UPDATE cart_items SET quantity = :quantity WHERE id = :cart_item_id AND cart_id = :cart_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':quantity', $new_quantity);
    $stmt->bindParam(':cart_item_id', $cart_item_id);
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function delete_cart_item_db(PDO $pdo, int $cart_item_id, int $cart_id): bool
{
    $query = "DELETE FROM cart_items WHERE id = :cart_item_id AND cart_id = :cart_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':cart_item_id', $cart_item_id);
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function get_or_create_cart_db(PDO $pdo, int $user_id): int
{
    $query = "SELECT id FROM carts WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart) {
        return (int)$cart['id'];
    } else {
        $query = "INSERT INTO carts (user_id) VALUES (:user_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return (int)$pdo->lastInsertId();
    }
}

// All business logic-related functions
function calculate_cart_totals(array $cart_items): array
{
    $subtotal = 0;
    foreach ($cart_items as $item) {
        $subtotal += ($item['price_cents'] / 100) * $item['quantity'];
    }

    $delivery_fee = 5.00;
    $total = $subtotal + $delivery_fee;

    return [
        'subtotal' => $subtotal,
        'delivery_fee' => $delivery_fee,
        'total' => $total,
    ];
}

// Handle AJAX POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $action = $_POST['action'];
    $response = ['success' => false];
    
    try {
        $cart_id = get_or_create_cart_db($pdo, $user_id);

        switch ($action) {
            case 'add':
                $product_variation_id = isset($_POST['product_variation_id']) ? (int)$_POST['product_variation_id'] : null;
                $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
                if ($product_variation_id !== null) {
                    $success = add_to_cart_db($pdo, $cart_id, $product_variation_id, $quantity);
                    $response['success'] = $success;
                } else {
                    $response['error'] = 'Missing product variation ID.';
                }
                break;
            case 'update_quantity':
                $cart_item_id = isset($_POST['cart_item_id']) ? (int)$_POST['cart_item_id'] : null;
                $new_quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null;
                if ($cart_item_id !== null && $new_quantity !== null) {
                    $success = update_cart_quantity_db($pdo, $cart_item_id, $cart_id, $new_quantity);
                    $response['success'] = $success;
                } else {
                    $response['error'] = 'Missing cart item ID or quantity.';
                }
                break;
            case 'delete':
                $cart_item_id = isset($_POST['cart_item_id']) ? (int)$_POST['cart_item_id'] : null;
                if ($cart_item_id !== null) {
                    $success = delete_cart_item_db($pdo, $cart_item_id, $cart_id);
                    $response['success'] = $success;
                } else {
                    $response['error'] = 'Missing cart item ID.';
                }
                break;
            default:
                $response['error'] = 'Invalid action.';
                break;
        }
    } catch (PDOException $e) {
        $response['error'] = 'Database error: ' . $e->getMessage();
    }
    
    echo json_encode($response);
    die();
}

$cart_items = get_cart_items($pdo, $user_id);
$prices = calculate_cart_totals($cart_items);

$subtotal = $prices['subtotal'];
$delivery_fee = $prices['delivery_fee'];
$total = $prices['total'];
?>