import { products } from "../data/productList.js";

// Export a function that generates the product HTML for a given product
// This makes it more flexible if you want to use it elsewhere too
function getProductFromList(id){
    const product = products.find(p => p.id === id);
    return product;
}
function generateProductHtml(productId) {
    let productHtml = ""; // Use a local variable to prevent re-exporting 'html' state

    // Find the product by ID
    const product = getProductFromList(productId);
        productHtml = `
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
            <p class="selected-price"></p>
            <p class="options">Опции за продукта:</p>
            <div class="variety">
              ${printProductOptions(product)}
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
        </article>`;
    
    return productHtml;
}

// Function to attach event listeners to product links
// This function will be called *after* the nav is loaded
/*export function setupProductLinkListeners() {
    const productLinks = document.querySelectorAll('.product');

    productLinks.forEach(link => {
        link.addEventListener('click',()=> {
            
            const productId = this.id; // Gets the ID from the 'id' attribute of the <a> tag

            localStorage.setItem('selectedProductId', productId); // Stores the ID

            window.location.href = 'productPage.html'; // <--- THIS is what actually navigates the page
        });
    });
}*/


// These functions are helpers for generating product options and formatting
function printProductOptions(product){
  
  let productOptions='';
  for(let i=0;i<product.options;i++){ // Assuming product.options is an array now
    let checked = i === 0 ? 'checked' : '';
    productOptions+=`<div class="option-box">
        <input
          type="radio"
          class="option-input"
          name="option"
          value="${i}"
          ${checked}
        />
        <p>${formatQuantity(product.weight[i])} - ${formatCurrency(product.priceCents[i])}</p>
      </div>
    `;
  }
  return productOptions;
}
 
  

function formatCurrency(priceCents){
  return (Math.round(priceCents) / 100).toFixed(2) + " лв";
}

function formatQuantity(weight){
  if(weight < 1000){
    return weight + " гр";
  }
  return (Math.round(weight) / 1000).toFixed(1) + " кг";
}



export const cart = [];
function setupAddToCartButton(product){
    const addToCartButton = document.querySelector('.add-to-cart');
    addToCartButton.addEventListener('click', ()=>{
        cart.push(product);
        localStorage.setItem("cart",cart);
    });
}


document.querySelector('.option-input');
document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.js-main-content');
    const selectedProductId = localStorage.getItem('selectedProductId');

    if (selectedProductId) {
        mainContent.innerHTML = generateProductHtml(selectedProductId);
        const product = getProductFromList(selectedProductId);
        setupAddToCartButton(product);
        localStorage.removeItem('selectedProductId');
        console.log(selectedProductId);
    } else {
        mainContent.innerHTML = '<h1>Вие не сте избрали продукт. Моля направете го от нашето меню.</h1>';
        console.warn("No product ID found in localStorage for productPage.html");
    }
});