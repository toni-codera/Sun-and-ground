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
    <link rel="stylesheet" href="styles/profileUser.css">
    <link rel="icon" type="image/png" href="images/logos/sun-and-ground.png">
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
                <div class="profile-row" data-target="logout">
                    <form action="includes/logout.inc.php" method="post">
                       <p class="profile-option">Изход</p> 
                    </form>
                    
                </div>
            </div>
        </aside>
        <section id="profile-content" class="profile-content">
            </section>
    </main>
    <?php require_once 'bookends/footer.php'; ?>
    <script src="/Sun_and_ground/scripts/myProfile.js"></script> 
</body>
</html>