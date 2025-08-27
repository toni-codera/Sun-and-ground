const header = document.querySelector('header');
const nav = document.querySelector('nav');
const footer = document.querySelector('footer');
const aside = document.querySelector('aside');

/*header.innerHTML = `
<div class="right-side-header">
    <a class="js-logo" href="index.php"><img class="logo-image" src="images/logos/sun-and-ground.png"/></a>
    <a class="js-logo" href="index.php"><h1 class="logo-text">Земя и слънце</h1></a>
</div>
<div class="left-side-header">
    <div class="phone-image-container">
        <img class="phone-image" src="images/logos/phone-call.png" />
        <div class="phone-number">
        <p>Телефон:</p>
        <p> 0895229715</p>
        </div>
    </div>
    <div class="profile-image-container js-login-container">
        <img class="profile-image" src="images/logos/farmer.png" />
        <p class="login-text">Вход/Регистрация</p>
    </div>
    <div class="basket-image-container">
        <a href="cart.php">
            <img class="basket-image" src="images/logos/wicker-basket1.png"/>
            <p class="basket-text">Кошница</p>
        </a>
    </div>
</div>
`;*/

/*nav.innerHTML = `
<ul class="menu">
    <li><a><div class="nav-logo-container"><img src="images/logos/dried-fruits-logo.png" class="nav-logo-img"></div><span>Сушени плодове</span></a>
      <ul class="sub-menu">
        <li><a class="product" id="0000-0001" href="#">Ягоди</a></li>
        <li><a class="product" id="0000-0010" href="#">Малини</a></li>
        <li><a class="product" id="0000-0011" href="#">Праскови</a></li>
        <li><a class="product" id="0000-0100" href="#">Кайсии</a></li>
        <li><a class="product" id="0000-0101" href="#">Черници</a></li>
        <li><a class="product" id="0000-0110" href="#">Бели черници</a></li>
        <li><a class="product" id="0000-0111" href="#">Смокини</a></li>
        <li><a class="product" id="0000-1000" href="#">Череши</a></li>
        <li><a class="product" id="0000-1001" href="#">Ябълка</a></li>
        <li><a class="product" id="0000-1010" href="#">Круши</a></li>
        <li><a class="product" id="0000-1011" href="#">Сливи</a></li>
      </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/compote-logo.png" class="nav-logo-img"></div><span>Компоти</span>
    <ul class="sub-menu">
      <li><a class="product" id="0000-1100" href="#">Ягоди</a></li>
      <li><a class="product" id="0000-1101" href="#">Праскови</a></li>
      <li><a class="product" id="0000-1110" href="#">Череши</a></li>
    </ul>
  </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/jam-logo.png" class="nav-logo-img"></div><span>Сладко</span></a>
      <ul class="sub-menu">
        <li><a class="product" id="0000-1111" href="#">Ягоди</a></li>
        <li><a class="product" id="0001-0000" href="#">Праскови</a></li>
        <li><a class="product" id="0001-0001" href="#">Боровинки</a></li>
        <li><a class="product" id="0001-0010" href="#">Кайсии</a></li>
        <li><a class="product" id="0001-0011" href="#">Смокини</a></li>
        <li><a class="product" id="0001-0100" href="#">Череши</a></li>
        <li><a class="product" id="0001-0101" href="#">Черници</a></li>
        <li><a class="product" id="0001-0110" href="#">Сливи</a></li>
      </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/pickle-logo.png" class="nav-logo-img"></div><span>Туршия</span></a>
    <ul class="sub-menu">
      <li><a class="product" id="0001-0111" href="#">Кисели краставички</a></li>
      <li><a class="product" id="0001-1000" href="#">Царска туршия</a></li>
      <li><a class="product" id="0001-1001" href="#">Люти чушки</a></li>
    </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/nuts-logo.png" class="nav-logo-img"></div><span>Ядки</span>
    <ul class="sub-menu">
        <li><a class="product" id="0001-1010" href="#">Бадеми</a></li>
        <li><a class="product" id="0001-1011" href="#">Орехи</a></li>
        <li><a class="product" id="0001-1100" href="#">Фъстъци</a></li>
      </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/dairy-logo.png" class="nav-logo-img"></div><span>Млечни продукти</span>
    <ul class="sub-menu">
      <li><a class="product" id="0001-1101" href="#">Саламурено сирене</a></li>
      <li><a class="product" id="0001-1110" href="#">Кашкавал</a></li>
      <li><a class="product" id="0001-1111" href="#">Пресно сирене</a></li>
      <li><a class="product" id="0010-0000" href="#">Кисело мляко</a></li>
    </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/honey-logo.png" class="nav-logo-img"></div><span>Пчелни продукти</span>
    <ul class="sub-menu">
      <li><a class="product" id="0010-0001" href="#">Мед</a></li>
      <li><a class="product" id="0010-0010" href="#">Пчелно млечице</a></li>
      <li><a class="product" id="0010-0011" href="#">Пчелен клей</a></li>
      <li><a class="product" id="0010-0100" href="#">Пчелен прашец</a></li>
    </ul>
    </li>
    <li><a><div class="nav-logo-container"><img src="images/logos/tea-logo.png" class="nav-logo-img"></div><span>Чай</span>
      <ul class="sub-menu">
        <li><a class="product" id="0010-0101" href="#">Лайка</a></li>
        <li><a class="product" id="0010-0110" href="#">Липа</a></li>
        <li><a class="product" id="0010-0111" href="#">Мащерка</a></li>
        <li><a class="product" id="0010-1000" href="#">Риган</a></li>
        <li><a class="product" id="0010-1001" href="#">Жълт кантарион</a></li>
        <li><a class="product" id="0010-1010" href="#">Бял равнец</a></li>
        <li><a class="product" id="0010-1011" href="#">Смокинови листа</a></li>
        <li><a class="product" id="0010-1100" href="#">Мента</a></li>
      </ul>
    </li>
  </ul>
`;*/

/*footer.innerHTML = `
<div class="footer-container">
    <div class="footer-section">
      <h3>Последвай ни:</h3>
      <div></div>
    </div>
    <div class="footer-section">
      <h3>Контакти</h3>
      <ul>
        <li>Адрес: Град Кресна, ул. "Спартак" №29</li>
        <li>Телефон: 089 522 9715</li>
        <li>Имейл: anton.k.todorov@gmail.com</li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Политики</h3>
      <ul>
        <li><a class="polices js-terms" href="#">Условия за ползване &<br> Политика за поверителност</a></li>
        <li><a class="polices js-delivery" href="#">Доставка и връщане</a></li>
      </ul>
    </div>
</div>
`;
*/
//The black box shown when aside login form pops
const blackBox = document.createElement('div');
blackBox.classList.add('js-black-box');
document.body.appendChild(blackBox);

// CSS loading of the bookends
/*function addStyles(filepath){
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = filepath;
    document.head.appendChild(link);
}
addStyles('../styles/main.css');
addStyles('../styles/login.css');
*/

//Login Pop-up/Pop-out Logic
const loginTrigger = document.querySelector(".js-login-container");

//Shows login form
/*loginTrigger.addEventListener("click", () => {
    aside.style.display = 'block';
    aside.style.opacity = '0';
    aside.style.transition = 'opacity 0.1s ease-in';
    setTimeout(() => {
        aside.style.opacity = '1';
    }, 100);
    setTimeout(() => {
        blackBox.classList.add("black-box");
    }, 100);
    window.location.href = "login.php";
});*/

// Function to handle login form exit
function exitLogin() {
    aside.style.opacity = '0';
    aside.style.transition = 'opacity 0.1s ease-out';
    setTimeout(() => {
        aside.style.display = 'none';
    }, 100);
    blackBox.classList.remove("black-box");
}


document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" || event.keyCode === 27) {
        exitLogin();
    }
});

blackBox.addEventListener("click", () => {
    exitLogin();
});


// Add event listeners to product links *AFTER* the nav is populated
document.addEventListener('DOMContentLoaded', () => {
    const productLinks = document.querySelectorAll('.product');

    productLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default link behavior
            const productId = link.id; // Gets the ID from the 'id' attribute of the <a> tag

            localStorage.setItem('selectedProductId', productId); // Stores the ID

            window.location.href = 'productPage.php'; // Navigate to the product page
        });
    });
});

//transfer to Terms&Policies onclick from footer
const terms = document.querySelector('.js-terms');
terms.addEventListener('click', ()=>{
  window.location.href = 'policyAndTerms.html';
})

//transfer to Delivery onclick from footer
const delivery = document.querySelector('.js-delivery');
delivery.addEventListener('click', ()=>{
  window.location.href = 'delivery.html';
})