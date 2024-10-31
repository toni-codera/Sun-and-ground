import { products } from "../data/productList.js"; 
export let html= "";

const productLinks = document.querySelectorAll('.product');

let clickedProductId;
productLinks.forEach(link => {
  link.addEventListener('click', function(event) {
    clickedProductId = event.target.id;
    console.log(clickedProductId);
    products.forEach((product) =>{
      console.log(product.id === clickedProductId)
      if(product.id === clickedProductId){
      html = `
      <article class="product-container">
        <img class="product-image" src="${product.image}" />
        <div class="product-info">
          <h1 class="name">${product.name}</h1>
          <p class="stats">
            <span class="stat-title">Категория:</span
            ><span class="sub-stats">${product.category}</span>
          </p>
          <p class="stats">
            <span class="stat-title">Сорт:</span
            ><span class="sub-stats">${product.variety}</span>
          </p>
          <p class="stats">
            <span class="stat-title">Отглеждане:</span
            ><span class="sub-stats">${product.cultivation}</span>
          </p>
          <p class="stats">
            <span class="stat-title">Особености:</span
            ><span class="sub-stats"
              >${product.characteristics}</span
            >
          </p>
          <p class="description">Кратко описание на продукта:</p>
          <p class="description-info">${product.briefDescription}</p>
        </div>
        <div class="buying-info">
          <h1 class="selected-price">${product.priceCents[0]}лв</h1>
          <p class="options">Опции за продукта:</p>
          <div class="variety">
            <div class="option-box">
              <input
                type="radio"
                class="option-input"
                name="option"
                value="option1"
              />
              <p>${product.quantity[0]}кг - ${product.priceCents[0]}лв</p>
            </div>
            <div class="option-box">
              <input
                type="radio"
                class="option-input"
                name="option"
                value="option2"
              />
              <p>${product.quantity[1]}кг - ${product.priceCents[1]}лв</p>
            </div>
            <div class="option-box">
              <input
                type="radio"
                class="option-input"
                name="option"
                value="option3"
              />
              <p>${product.quantity[2]}кг - ${product.priceCents[2]}лв</p>
            </div>
            <div class="option-box">
              <input
                type="radio"
                class="option-input"
                name="option"
                value="option4"
              />
              <p>${product.quantity[3]}кг - ${product.priceCents[3]}лв</p>
            </div>
          </div>
          <div class="processing">
            <div>
              <a><i></i></a>
              <div><input class="quantity" type="text" /></div>
              <a><i></i></a>
            </div>
            <button class="add-to-cart">Добави в количката</button>
            <button class="buy-now">Купи сега</button>
          </div>
        </div>
        </article>`
      }
    });
  });
  document.querySelector(".js-main-content").innerHTML = html;
});