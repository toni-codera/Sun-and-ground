<?php
require_once __DIR__ . '/includes/config_session.inc.php';
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] !== 1) {
    header("Location: /Sun_and_ground/index.php");
    exit();
}
require_once __DIR__ . '/includes/admin_fetch_orders.inc.php';
$orders = admin_fetch_orders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logos/sun-and-ground.png">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/profileAdmin.css">
    <title>Админ Панел</title>
</head>
<body>
    <?php require_once "bookends/header.php"; ?>
    <main>
        <section class="admin-orders">
            <div class="admin-orders-header">
                <h2>Поръчки в обработка</h2>
                <form action="includes/logout.inc.php" method="post">
                    <button class="logout-admin-button">Изход</button>
                </form>
            </div>
            <div class="orders-container">
                <?php
                $pending_orders = array_filter($orders, fn($order) => $order['is_sent'] === false);
                if (empty($pending_orders)): ?>
                    <p>Няма поръчки за изпращане.</p>
                <?php else:
                    foreach ($pending_orders as $order): ?>
                        <div class="order-card">
                            <div class="order-products-column">
                                <h3>Продукти</h3>
                                <?php
                                $total_price = 0;
                                foreach ($order['items'] as $item):
                                    $item_total = ($item['price_cents'] / 100) * $item['quantity'];
                                    $total_price += $item_total;
                                    ?>
                                    <p>
                                        <?php echo htmlspecialchars($item['product_name']); ?> -
                                        <?php echo htmlspecialchars($item['weight_grams']); ?> гр. (x<?php echo htmlspecialchars($item['quantity']); ?>)
                                    </p>
                                <?php endforeach; ?>
                                <hr>
                                <h4>Обща сума: <?php echo number_format($total_price, 2); ?> лв.</h4>
                            </div>
                            <div class="order-user-column">
                                <h3>Данни на клиента</h3>
                                <p><strong>Име:</strong> <?php echo htmlspecialchars($order['user_info']['firstname'] . ' ' . $order['user_info']['lastname']); ?></p>
                                <p><strong>Имейл:</strong> <?php echo htmlspecialchars($order['user_info']['email']); ?></p>
                                <p><strong>Телефон:</strong> <?php echo htmlspecialchars($order['user_info']['phone']); ?></p>
                                <p><strong>Адрес:</strong> <?php echo htmlspecialchars($order['user_info']['home_address']); ?></p>
                            </div>
                            <div class="order-action-column">
                                <h3>Действие</h3>
                                <p><strong>Поръчка №:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
                                <p><strong>Дата:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                                <form action="includes/update_order_status.inc.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                    <button type="submit" class="mark-sent-button">Изпрати</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
            
            <hr class="section-divider">

            <h2>Изпратени поръчки</h2>
            <div class="orders-container">
                <?php
                $sent_orders = array_filter($orders, fn($order) => $order['is_sent'] === true);
                if (empty($sent_orders)): ?>
                    <p>Все още няма изпратени поръчки.</p>
                <?php else:
                    foreach ($sent_orders as $order): ?>
                        <div class="order-card sent">
                            <div class="order-products-column">
                                <h3>Продукти</h3>
                                <?php
                                $total_price = 0;
                                foreach ($order['items'] as $item):
                                    $item_total = ($item['price_cents'] / 100) * $item['quantity'];
                                    $total_price += $item_total;
                                    ?>
                                    <p>
                                        <?php echo htmlspecialchars($item['product_name']); ?> -
                                        <?php echo htmlspecialchars($item['weight_grams']); ?> гр. (x<?php echo htmlspecialchars($item['quantity']); ?>)
                                    </p>
                                <?php endforeach; ?>
                                <hr>
                                <h4>Обща сума: <?php echo number_format($total_price, 2); ?> лв.</h4>
                            </div>
                            <div class="order-user-column">
                                <h3>Данни на клиента</h3>
                                <p><strong>Име:</strong> <?php echo htmlspecialchars($order['user_info']['firstname'] . ' ' . $order['user_info']['lastname']); ?></p>
                                <p><strong>Имейл:</strong> <?php echo htmlspecialchars($order['user_info']['email']); ?></p>
                                <p><strong>Телефон:</strong> <?php echo htmlspecialchars($order['user_info']['phone']); ?></p>
                                <p><strong>Адрес:</strong> <?php echo htmlspecialchars($order['user_info']['home_address']); ?></p>
                            </div>
                            <div class="order-action-column">
                                <h3>Статус</h3>
                                <p><strong>Поръчка №:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
                                <p><strong>Дата:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                                <button class="mark-sent-button" disabled>Изпратена</button>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
        </section>
    </main>
    <script src="/Sun_and_ground/scripts/navigate.js"></script>
</body>
</html>