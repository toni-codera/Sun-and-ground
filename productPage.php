<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Земя и слънце</title>
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/login.css" />
</head>

<body>
    <aside class="js-login-form"></aside>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    <main class="js-main-content"></main>
    <?php require_once 'bookends/footer.php'; ?>
</body>
<script src="scripts/loadBookends.js"></script>
<script type="module" src="scripts/productLoad.js"></script>

</html>