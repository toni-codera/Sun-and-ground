<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/home.css" />
    <link rel="stylesheet" href="styles/products.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logos/sun-and-ground.png">
    <title>Земя и слънце</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php require_once 'bookends/header.php';?>
    <?php require_once 'bookends/nav.php';?>
    <section class="js-main-content">
        <article>
            <img class="farm-back-image" src="images/others/back.jpg" />
        </article>
        <article>
            <div class="about-container">
                <h1>За нас</h1>
                <div class="about">
                    Вярвайки в силата на природата, ние създадохме нашата ферма в хармония
                    с околната среда. Целта ни е да произвеждаме чиста и здравословна
                    храна,като същевременно опазваме почвата и биоразнообразието. Нашите
                    мандра, трайни насаждения и сезонните плодове и зеленчуци се разполага
                    на близо 3 хектара площ в креснеското поле. Започнахме с малко през
                    2001 година, а вече сме един от най големите производители в региона,
                    който е познат със своите благородни земи. Доверявайки се на нашите
                    услуги, вие ще получите истински и био продукти, защото ние не
                    използваме опасни химикали и торове.
                </div>
                <div class="starting-date">
                    <p class="from">OT</p>
                    <div class="about-image-box">
                        <img class="logo-in-about" src="images/logos/sun-and-ground.png" />
                    </div>
                    <p class="year">2001</p>
                </div>
            </div>
        </article>
        <article>
            <div class="cows">
                <div>
                    <span>
                        Нашите млечни продукти са благодарение на <br />
                        свободно отглежданите ни и щастливи крави.
                    </span>
                    <img class="dairy-products" src="images/others/dairy_products.png" />
                </div>
            </div>
        </article>
        <article>
            <div>
                <div class="action-text-container">
                    <h1 class="action-text">Какво правим ние</h1>
                </div>
                <div class="actions-container">
                    <div class="farming">
                        <img class="action-image" src="images/logos/farming.png" />
                        <p>Производство</p>
                    </div>
                    <div class="processing">
                        <img class="action-image" src="images/logos/processing.png" />
                        <p>Преработка</p>
                    </div>
                    <div class="packaging">
                        <img class="action-image" src="images/logos/packaging.png" />
                        <p>Опаковане</p>
                    </div>
                    <div class="distribution">
                        <img class="action-image" src="images/logos/distribution.png" />
                        <p>Доставка</p>
                    </div>
                    <div class="marketing">
                        <img class="action-image" src="images/logos/marketing.png" />
                        <p>Маркетинг</p>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <?php require_once 'bookends/footer.php';?>
    <script src="scripts/loadBookends.js"></script>
</body>

</html>