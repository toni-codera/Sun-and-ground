<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/dbh.inc.php';

// Check if a product ID is provided and is a number.
// If not, redirect to the homepage to prevent errors.
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$product_id = (int)$_GET['id'];

// Prepare and execute a query to fetch the specific product and its variations.
// The INNER JOIN ensures that only products with at least one variation are found.
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

// If no product is found (e.g., the ID doesn't exist or has no variations),
// redirect the user back to the homepage.
if (!$data) {
    header('Location: index.php');
    exit();
}

// Group the variations under the main product details.
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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($product['name']); ?> - Земя и слънце</title>
    <link rel="stylesheet" href="/Sun_and_ground/styles/products.css">
    <link rel="stylesheet" href="/Sun_and_ground/styles/main.css" />
    <link rel="stylesheet" href="/Sun_and_ground/styles/login.css" />
</head>
<body>
    <aside class="js-login-form"></aside>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    
    <main class="js-main-content">
        <article class="product-container">
            <img class="product-image" src="<?php echo htmlspecialchars($product['image_path']); ?>" />
            <div class="product-info">
                <h1 class="name"><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="stats"><span class="stat-title">Категория:</span><span class="sub-stats"><?php echo htmlspecialchars($product['category']); ?></span></p>
                <p class="stats"><span class="stat-title">Сорт:</span><span class="sub-stats"><?php echo htmlspecialchars($product['variety']); ?></span></p>
                <p class="stats"><span class="stat-title">Отглеждане:</span><span class="sub-stats"><?php echo htmlspecialchars($product['cultivation']); ?></span></p>
                <p class="stats"><span class="stat-title">Особености:</span><span class="sub-stats"><?php echo htmlspecialchars($product['characteristics']); ?></span></p>
                <p class="description">Кратко описание на продукта:</p>
                <p class="description-info"><?php echo htmlspecialchars($product['brief_description']); ?></p>
            </div>
            <div class="buying-info">
                <p class="selected-price"></p>
                <p class="options">Опции за продукта:</p>
                <div class="variety">
                    <?php
                    // Helper function to format weight
                    function formatQuantity($weight) {
                        if ($weight < 1000) {
                            return $weight . " гр.";
                        }
                        return number_format($weight / 1000, 1) . " кг.";
                    }
                    // Helper function to format price
                    function formatCurrency($priceCents) {
                        return number_format($priceCents / 100, 2) . " лв.";
                    }
                    
                    foreach ($product['variations'] as $index => $variation) {
                        $checked = ($index === 0) ? 'checked' : '';
                        echo '
                            <div class="option-box">
                                <input
                                    type="radio"
                                    class="option-input"
                                    name="option"
                                    value="' . htmlspecialchars($variation['id']) . '"
                                    ' . $checked . '
                                />
                                <p>' . formatQuantity($variation['weight_grams']) . ' - ' . formatCurrency($variation['price_cents']) . '</p>
                            </div>
                        ';
                    }
                    ?>
                </div>
                <div class="processing">
                    <button class="add-to-cart" data-product-id="<?php echo $product_id; ?>">Добави в количката</button>
                    <button class="buy-now">Купи сега</button>
                </div>
            </div>
        </article>
    </main>
    <?php require_once 'bookends/footer.php'; ?>
</body>
<script src="/Sun_and_ground/scripts/loadBookends.js"></script>
</html>