import { cart } from "./productLoad.js";
document.addEventListener('DOMContentLoaded', () => {
    const deliveryPrice = 8.99;
    const cartInventory = document.querySelector('.cart-inventory');
    const productPriceElement = document.querySelector('.price-product-value');
    const totalDeliveryElement = document.querySelector('.price-delivery-value');
    const totalPriceElement = document.querySelector('.price-total-value');

    function updateCartTotals() {
        let totalProductPrice = 0;
        const currentCartContainers = cartInventory.querySelectorAll('.cart-container');

        if (currentCartContainers.length === 0) {
            productPriceElement.textContent = `0.00лв`;
            totalDeliveryElement.textContent = `0.00лв`;
            totalPriceElement.textContent = `0.00лв`;
        } else {
            currentCartContainers.forEach(container => {
                const quantityInput = container.querySelector('.cart-item-quantity');
                const itemTotalPriceElement = container.querySelector('.item-total-price');
                const productPrice = parseFloat(container.dataset.productPrice);
                const quantity = parseInt(quantityInput.value);

                const itemTotalPrice = productPrice * quantity;
                itemTotalPriceElement.textContent = `${itemTotalPrice.toFixed(2)}лв`;
                totalProductPrice += itemTotalPrice;
            });

            productPriceElement.textContent = `${totalProductPrice.toFixed(2)}лв`;
            totalDeliveryElement.textContent = `${deliveryPrice.toFixed(2)}лв`;
            totalPriceElement.textContent = `${(totalProductPrice + deliveryPrice).toFixed(2)}лв`;
        }
    }
    
    
    cartInventory.querySelectorAll('.cart-container').forEach(container => {
        const minusButton = container.querySelector('.quantity-button.minus');
        const plusButton = container.querySelector('.quantity-button.plus');
        const quantityInput = container.querySelector('.cart-item-quantity');
        const deleteButton = container.querySelector('.cart-delete-item');

        // Initial update for each item's total price
        const productPrice = parseFloat(container.dataset.productPrice);
        const initialQuantity = parseInt(quantityInput.value);
        container.querySelector('.item-total-price').textContent = `${(productPrice * initialQuantity).toFixed(2)}лв`;

        minusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > parseInt(quantityInput.min)) {
                quantityInput.value = currentValue - 1;
                updateCartTotals();
            }
        });

        plusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < parseInt(quantityInput.max)) {
                quantityInput.value = currentValue + 1;
                updateCartTotals();
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
            updateCartTotals();
        });

        deleteButton.addEventListener('click', () => {
            container.remove();
            updateCartTotals(); // Recalculate totals after removing an item
        });
    });

    // Initial update of all cart totals when the page loads
    updateCartTotals();
});


function fillCart(cart){
    const cartHtml = '';
    
    cart.forEach(product => {
        cartHtml += `
            <div class="cart-item-container" data-product-price="8.99">
          <div class="cart-product-container">
            <div class="cart-image-container">
              <img class="cart-image" src="${product.image}" />
            </div>
            <div class="cart-product-info-container">
              <h1 class="cart-product-name">${product.name} ${product}</h1>
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
                    min="0"
                    max="100"
                    value="1"
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
              <span class="item-total-price">8.99лв</span>
            </div>
          </div>
        </div>
        `
    });
}
fillCart(cart);
console.log(cart);