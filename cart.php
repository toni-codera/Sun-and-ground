<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php'
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
            </div>
        </section>

        <section class="cart-checkout">
            <div class="price-header-container">
                <p class="price-main-text">Информация за плащането:</p>
                <hr />
            </div>
            <div class="checkout">
                <div class="price-product">
                    <span class="price-product-text">Цена на продукт:</span>
                    <span class="price-product-value">0.00лв</span>
                </div>
                <div class="price-delivery">
                    <span class="price-delivery-text">Доставка:</span>
                    <span class="price-delivery-value">0.00лв</span>
                </div>
                <div class="price-total">
                    <span class="price-total-text">Крайна цена:</span>
                    <span class="price-total-value">0.00лв</span>
                </div>
                <button class="complete-shopping-button">Купи</button>
            </div>
        </section>
    </main>
    <?php require_once 'bookends/footer.php'; ?>
    <script src="/Sun_and_ground/scripts/loadBookends.js"></script>
    <script type="module" src="/Sun_and_ground/scripts/cart.js"></script>
</body>

</html>