<?php
require_once 'includes/cart.inc.php';
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="styles/cart.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="icon" type="image/png" href="/Sun_and_ground/images/logos/sun-and-ground.png">
    <title>Кошница</title>
    <script
        src="https://kit.fontawesome.com/96dd69d61c.js"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    <main class="cart">
        <section class="cart-inventory">
            <div class="cart-header-container">
                <p class="cart-details-text">Детайли за кошницата</p>
                <hr />
            </div>

            <div class="cart-container">
                <?php if (empty($cart_items)): ?>
                    <p class="empty-cart-text">Вашата количка е празна.</p>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item-display" data-cart-item-id="<?php echo htmlspecialchars($item['id']); ?>">
                            <div class="cart-product-container">
                                <div class="cart-image-container">
                                    <img class="cart-image" src="<?php echo htmlspecialchars($item['image_path']); ?>" />
                                </div>
                                <div class="cart-product-info-container">
                                    <h1 class="cart-product-name">
                                        <?php echo htmlspecialchars($item['product_name']); ?> - <?php echo htmlspecialchars($item['weight_grams']); ?> гр.
                                    </h1>
                                    <button class="cart-delete-item">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span>Изтрий от количката</span>
                                    </button>
                                </div>
                                <div class="cart-quantity-container">
                                    <div class="cart-quantity">
                                        <div>
                                            <button class="quantity-button minus">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <input
                                                class="cart-item-quantity"
                                                type="number"
                                                min="1"
                                                max="100"
                                                value="<?php echo htmlspecialchars($item['quantity']); ?>"
                                            />
                                        </div>
                                        <div>
                                            <button class="quantity-button plus">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-price-container">
                                    <span class="item-total-price">
                                        <?php echo number_format(($item['price_cents'] / 100) * $item['quantity'], 2); ?> лв.
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <section class="cart-checkout">
            <div class="price-header-container">
                <p class="price-main-text">Информация за плащането:</p>
                <hr />
            </div>
            <div class="checkout">
                <div class="price-product">
                    <span class="price-product-text">Цена на продукти:</span>
                    <span class="price-product-value"><?php echo number_format($subtotal, 2); ?> лв.</span>
                </div>
                <div class="price-delivery">
                    <span class="price-delivery-text">Доставка:</span>
                    <span class="price-delivery-value"><?php echo number_format($delivery_fee, 2); ?> лв.</span>
                </div>
                <div class="price-total">
                    <span class="price-total-text">Крайна цена:</span>
                    <span class="price-total-value"><?php echo number_format($total, 2); ?> лв.</span>
                </div>
                <form action="/Sun_and_ground/includes/process_order.inc.php" method="POST">
                    <button class="complete-shopping-button">Купи</button>
                </form>
            </div>
        </section>
    </main>
    <?php require_once 'bookends/footer.php'; ?>
    <script type="module" src="/Sun_and_ground/scripts/cart.js"></script>
</body>
</html>