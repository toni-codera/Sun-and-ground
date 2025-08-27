<?php
require_once 'includes/config_session.inc.php';
// Check if user is logged in, redirect if not
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/profile.css">
    <title>Моят Профил</title> </head>
<body>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    <main>
        <aside class="profile-options">
            <div class="profile-options-header">
                <p class="profile-options-header-text">Вашия профил</p>
            </div>
            <hr class="profile-divider"> <div class="profile-options-list">
                <div class="profile-row active" data-target="personal-info">
                    <p class="profile-option">Лична информация</p>
                </div>
                <div class="profile-row" data-target="my-orders">
                    <p class="profile-option">Моите поръчки</p>
                </div>
                <div class="profile-row" data-target="change-name">
                    <p class="profile-option">Смяна на име</p>
                </div>
                <div class="profile-row" data-target="change-password">
                    <p class="profile-option">Смяна на парола</p>
                </div>
                <div class="profile-row" data-target="change-email">
                    <p class="profile-option">Смяна на имейл</p>
                </div>
                <div class="profile-row" data-target="change-address">
                    <p class="profile-option">Смяна на адрес</p>
                </div>
                <div class="profile-row" data-target="change-phone">
                    <p class="profile-option">Смяна на телефон</p>
                </div>
                <div class="profile-row" data-target="logout">
                    <p class="profile-option">Изход</p>
                </div>
            </div>
        </aside>
        <section id="profile-content" class="profile-content">
            </section>
    </main>
    <?php require_once 'bookends/footer.php'; ?>
    <script>
        // Embed user data from PHP session into JavaScript
        const userData = <?php
        echo json_encode([
            'firstName' => $_SESSION['firstname'] ?? 'N/A',
            'lastName' => $_SESSION['lastname'] ?? 'N/A',
            'email' => $_SESSION['email'] ?? 'N/A',
            'phone' => $_SESSION['phone'] ?? 'N/A',
            'city' => $_SESSION['city'] ?? 'N/A',
            'address' => $_SESSION['home_address'] ?? 'N/A'
        ]);
        ?>;
    </script>
    <script src="scripts/myProfile.js"></script> </body>
</html>