<?php
declare(strict_types=1);

// This file is the Model. It handles all data-related logic for the product page.

// Include necessary files for session and database connection.
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';


// Check if a product ID is provided and is a number.
// If not, redirect to the homepage to prevent errors.
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$product_id = (int)$_GET['id'];

// Prepare and execute a query to fetch the specific product and its variations.
$query = "
    SELECT
        p.id AS product_id,
        p.name AS product_name,
        p.category,
        p.variety,
        p.image_path,
        p.cultivation,
        p.characteristics,
        p.brief_description,
        pv.id as variation_id,
        pv.weight_grams,
        pv.price_cents
    FROM
        products p
    INNER JOIN
        product_variations pv ON p.id = pv.product_id
    WHERE
        p.id = :product_id
    ORDER BY
        pv.weight_grams;
";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$data) {
    header('Location: index.php');
    exit();
}

$product = [
    'name' => $data[0]['product_name'],
    'category' => $data[0]['category'],
    'image_path' => $data[0]['image_path'],
    'variety' => $data[0]['variety'],
    'cultivation' => $data[0]['cultivation'],
    'characteristics' => $data[0]['characteristics'],
    'brief_description' => $data[0]['brief_description'],
    'variations' => []
];

foreach ($data as $row) {
    $product['variations'][] = [
        'id' => $row['variation_id'],
        'weight_grams' => $row['weight_grams'],
        'price_cents' => $row['price_cents']
    ];
}

function formatQuantity($weight) {
    if ($weight < 1000) {
        return $weight . " гр.";
    }
    return number_format($weight / 1000, 1) . " кг.";
}

function formatCurrency($priceCents) {
    return number_format($priceCents / 100, 2) . " лв.";
}
