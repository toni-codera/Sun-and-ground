import { products } from "../data/productList.js";

const CART_STORAGE_KEY = 'shoppingCart';

function loadCartFromStorage() {
    const storedCart = localStorage.getItem(CART_STORAGE_KEY);
    return storedCart ? JSON.parse(storedCart) : [];
}

function saveCartToStorage(currentCart) {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(currentCart));
}

let cart = loadCartFromStorage();

function addToCart(productId, quantity = 1, optionIndex = 0) {
    const productDetails = products.find(p => p.id === productId);
    if (!productDetails) {
        console.error(`Product with ID ${productId} not found.`);
        return;
    }

    const existingItemIndex = cart.findIndex(item =>
        item.productId === productId && item.optionIndex === optionIndex
    );

    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
    } else {
        cart.push({
            productId: productId,
            quantity: quantity,
            optionIndex: optionIndex
        });
    }

    saveCartToStorage(cart);
    console.log('Cart after adding:', cart);
    alert('Продуктът е добавен в количката!');
}

function setupAddToCartButton(productId) {
    const addToCartButton = document.querySelector('.add-to-cart');
    const quantityInput = document.querySelector('.quantity');
    const optionRadios = document.querySelectorAll('input[name="option"]');

    if (addToCartButton) {
        addToCartButton.addEventListener('click', () => {
            const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
            let selectedOptionIndex = 0;

            const checkedOption = Array.from(optionRadios).find(radio => radio.checked);
            if (checkedOption) {
                selectedOptionIndex = parseInt(checkedOption.value);
            }

            addToCart(productId, quantity, selectedOptionIndex);
        });
    } else {
        console.error("Add to Cart button not found.");
    }
}

export function getProductFromList(id) {
    const product = products.find(p => p.id === id);
    return product;
}

export function generateProductHtml(productId) {
    const product = getProductFromList(productId);
    if (!product) return '<h1>Продуктът не е намерен.</h1>';

    return `
        <article class="product-container">
            <img class="product-image" src="${product.image}" />
            <div class="product-info">
                <h1 class="name">${product.name}</h1>
                <p class="stats"><span class="stat-title">Категория:</span><span class="sub-stats">${product.category}</span></p>
                <p class="stats"><span class="stat-title">Сорт:</span><span class="sub-stats">${product.variety}</span></p>
                <p class="stats"><span class="stat-title">Отглеждане:</span><span class="sub-stats">${product.cultivation}</span></p>
                <p class="stats"><span class="stat-title">Особености:</span><span class="sub-stats">${product.characteristics}</span></p>
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
                    <button class="add-to-cart">Добави в количката</button>
                    <button class="buy-now">Купи сега</button>
                </div>
            </div>
        </article>`;
}

function printProductOptions(product) {
    let productOptions = '';
    for(let i = 0; i < product.options; i++){
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

function formatCurrency(priceCents) {
    return (Math.round(priceCents) / 100).toFixed(2) + " лв";
}

function formatQuantity(weight) {
    if (weight < 1000) {
        return weight + " гр";
    }
    return (Math.round(weight) / 1000).toFixed(1) + " кг";
}

document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.js-main-content');
    const selectedProductId = localStorage.getItem('selectedProductId');

    if (mainContent && selectedProductId) {
        mainContent.innerHTML = generateProductHtml(selectedProductId);
        setupAddToCartButton(selectedProductId);
        localStorage.removeItem('selectedProductId');
        console.log("Product Page: Product ID loaded:", selectedProductId);
    }
    else if (mainContent && !selectedProductId) {
        console.warn("Product Load: No product ID found in localStorage, not loading product details.");
    }

})