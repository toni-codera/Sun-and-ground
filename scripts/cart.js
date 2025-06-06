import { products } from "../data/productList.js";

const CART_STORAGE_KEY = 'shoppingCart';

function loadCartFromStorage() {
    const storedCart = localStorage.getItem(CART_STORAGE_KEY);
    return storedCart ? JSON.parse(storedCart) : [];
}

function saveCartToStorage(currentCart) {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(currentCart));
}

const deliveryPrice = 8.99;

function renderCartItems() {
    const cartInventory = document.querySelector('.cart-inventory');

    const itemsContainer = cartInventory ? cartInventory.querySelector('.cart-container') : null;

    if (!itemsContainer) { 
        console.warn("'.cart-container' (for items) not found within '.cart-inventory'. Cannot render cart items.");
        return;
    }

    let itemsHtml = '';
    const currentCart = loadCartFromStorage();

    if (currentCart.length === 0) {
        itemsContainer.innerHTML = '<p class="empty-cart-message">Вашата количка е празна.</p>';
    } else {
        currentCart.forEach(cartItem => {
            const product = products.find(p => p.id === cartItem.productId);
            if (!product) {
                console.warn(`Product with ID ${cartItem.productId} not found in product list.`);
                return;
            }

            const itemPriceCents = product.priceCents?.[cartItem.optionIndex] || 0;
            const itemWeight = product.weight?.[cartItem.optionIndex] || 0;

            const formattedPrice = (Math.round(itemPriceCents) / 100).toFixed(2);
            function formatCurrency(priceCents){ return (Math.round(priceCents) / 100).toFixed(2) + " лв"; }
            function formatQuantity(weight){ if(weight < 1000){ return weight + " гр"; } return (Math.round(weight) / 1000).toFixed(1) + " кг"; }

            itemsHtml += `
                <div class="cart-item-display" data-product-id="${cartItem.productId}" data-option-index="${cartItem.optionIndex}" data-product-price="${formattedPrice}">
                    <div class="cart-product-container">
                        <div class="cart-image-container">
                            <img class="cart-image" src="${product.image}" />
                        </div>
                        <div class="cart-product-info-container">
                            <h1 class="cart-product-name">${product.name} - ${formatQuantity(itemWeight)}</h1>
                            <button class="cart-delete-item">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Изтрий от количката</span>
                            </button>
                        </div>
                        <div class="cart-quantity-container">
                            <div class="cart-quantity">
                                <div>
                                    <button class="quantity-button minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                                <div>
                                    <input
                                        class="cart-item-quantity"
                                        type="number"
                                        min="1"
                                        max="100"
                                        value="${cartItem.quantity}"
                                    />
                                </div>
                                <div>
                                    <button class="quantity-button plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="cart-price-container">
                            <span class="item-total-price">${(parseFloat(formattedPrice) * cartItem.quantity).toFixed(2)}лв</span>
                        </div>
                    </div>
                </div>
            `;
        });
        itemsContainer.innerHTML = itemsHtml; 

        attachCartItemEventListeners();
    }
    updateCartTotals();
}

function attachCartItemEventListeners() {
    const itemsContainer = document.querySelector('.cart-inventory .cart-container'); 
    if (!itemsContainer) return; 

    itemsContainer.querySelectorAll('.cart-item-display').forEach(container => {
        const minusButton = container.querySelector('.quantity-button.minus');
        const plusButton = container.querySelector('.quantity-button.plus');
        const quantityInput = container.querySelector('.cart-item-quantity');
        const deleteButton = container.querySelector('.cart-delete-item');

        const productId = container.dataset.productId;
        const optionIndex = parseInt(container.dataset.optionIndex);

        minusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > parseInt(quantityInput.min)) {
                quantityInput.value = currentValue - 1;
                updateCartItemQuantityData(productId, optionIndex, parseInt(quantityInput.value));
            }
        });

        plusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < parseInt(quantityInput.max)) {
                quantityInput.value = currentValue + 1;
                updateCartItemQuantityData(productId, optionIndex, parseInt(quantityInput.value));
            }
        });

        quantityInput.addEventListener('change', () => {
            let value = parseInt(quantityInput.value);
            const min = parseInt(quantityInput.min);
            const max = parseInt(quantityInput.max);

            if (isNaN(value) || value < min) {
                quantityInput.value = min;
            } else if (value > max) {
                quantityInput.value = max;
            }
            updateCartItemQuantityData(productId, optionIndex, parseInt(quantityInput.value));
        });

        deleteButton.addEventListener('click', () => {
            removeFromCartData(productId, optionIndex);
        });
    });
}

function updateCartTotals() {
    const productPriceElement = document.querySelector('.price-product-value');
    const totalDeliveryElement = document.querySelector('.price-delivery-value');
    const totalPriceElement = document.querySelector('.price-total-value');
    const itemsContainer = document.querySelector('.cart-inventory .cart-container');

    if (!itemsContainer) return;

    let totalProductPrice = 0;
    const currentCartItemDisplays = itemsContainer.querySelectorAll('.cart-item-display');

    if (currentCartItemDisplays.length === 0) {
        productPriceElement.textContent = `0.00лв`;
        totalDeliveryElement.textContent = `0.00лв`;
        totalPriceElement.textContent = `0.00лв`;
    } else {
        currentCartItemDisplays.forEach(container => {
            const quantityInput = container.querySelector('.cart-item-quantity');
            const productPrice = parseFloat(container.dataset.productPrice);
            const quantity = parseInt(quantityInput.value);

            const itemTotalPrice = productPrice * quantity;
            container.querySelector('.item-total-price').textContent = `${itemTotalPrice.toFixed(2)}лв`;
            totalProductPrice += itemTotalPrice;
        });

        productPriceElement.textContent = `${totalProductPrice.toFixed(2)}лв`;
        totalDeliveryElement.textContent = `${deliveryPrice.toFixed(2)}лв`;
        totalPriceElement.textContent = `${(totalProductPrice + deliveryPrice).toFixed(2)}лв`;
    }
}

function removeFromCartData(productId, optionIndex) {
    let cart = loadCartFromStorage();
    cart = cart.filter(item => !(item.productId === productId && item.optionIndex === optionIndex));
    saveCartToStorage(cart);
    renderCartItems();
}

function updateCartItemQuantityData(productId, optionIndex, newQuantity) {
    let cart = loadCartFromStorage();
    const item = cart.find(item => item.productId === productId && item.optionIndex === optionIndex);
    if (item) {
        item.quantity = newQuantity;
        if (item.quantity <= 0) {
            removeFromCartData(productId, optionIndex);
        } else {
            saveCartToStorage(cart);
            updateCartTotals();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.cart-inventory .cart-container')) {
        renderCartItems();
    }
});