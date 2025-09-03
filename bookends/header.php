<?php
//Include the session config file to make $_SESSION data available.
require_once __DIR__ . '/../includes/config_session.inc.php'; 

//Check if the user_id session variable is set to determine login status.
$is_logged_in = isset($_SESSION["user_id"]);
?>
<header>
    <div class="right-side-header">
        <a class="js-logo" href="/Sun_and_ground/index.php"><img class="logo-image" src="/Sun_and_ground/images/logos/sun-and-ground.png"/></a>
        <a class="js-logo" href="/Sun_and_ground/index.php"><h1 class="logo-text">Земя и слънце</h1></a>
    </div>
    <div class="left-side-header">
        <div class="phone-image-container">
            <img class="phone-image" src="/Sun_and_ground/images/logos/phone-call.png" />
            <div class="phone-number">
                <p>Телефон:</p>
                <p> 0895229715</p>
            </div>
        </div>
        <div class="profile-image-container">
            <a href="<?php echo $is_logged_in ? '/Sun_and_ground/profileUser.php' : '/Sun_and_ground/login.php'; ?>">
                <img class="profile-image" src="/Sun_and_ground/images/logos/farmer.png" />
                <p class="login-text"><?php echo $is_logged_in ? 'Профил' : 'Вход/Регистрация'; ?></p>
            </a>
        </div>
        <div class="basket-image-container">
            <a href="/Sun_and_ground/cart.php">
                <img class="basket-image" src="/Sun_and_ground/images/logos/wicker-basket1.png"/>
                <p class="basket-text">Кошница</p>
            </a>
        </div>
    </div>
</header>