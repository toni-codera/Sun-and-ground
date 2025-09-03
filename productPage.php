<?php
// This file is the View. It presents the data fetched by the model.
require_once 'includes/product.inc.php';
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
    <link rel="icon" type="image/png" href="/Sun_and_ground/images/logos/sun-and-ground.png">
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
                    <?php foreach ($product['variations'] as $index => $variation): ?>
                        <div class="option-box">
                            <input
                                type="radio"
                                class="option-input"
                                name="option"
                                value="<?php echo htmlspecialchars($variation['id']); ?>"
                                <?php echo ($index === 0) ? 'checked' : ''; ?>
                            />
                            <p><?php echo formatQuantity($variation['weight_grams']) . ' - ' . formatCurrency($variation['price_cents']); ?></p>
                        </div>
                    <?php endforeach; ?>
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
<script src="/Sun_and_ground/scripts/productLoad.js"></script>
</html>