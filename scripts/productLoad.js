const selectedProductId = localStorage.getItem('selectedProductId');
console.log('Selected Product ID:', selectedProductId);

const CART_STORAGE_KEY = 'shoppingCart';

function loadCartFromStorage() {
    const storedCart = localStorage.getItem(CART_STORAGE_KEY);
    return storedCart ? JSON.parse(storedCart) : [];
}

function saveCartToStorage(currentCart) {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(currentCart));
}

let cart = loadCartFromStorage();

function addToCart(productId, quantity = 1, variationId) {
    const existingItemIndex = cart.findIndex(item =>
        item.productId === productId && item.variationId === variationId
    );

    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
    } else {
        cart.push({
            productId: productId,
            quantity: quantity,
            variationId: variationId
        });
    }

    saveCartToStorage(cart);
    console.log('Cart after adding:', cart);
    alert('Продуктът е добавен в количката!');
}

function setupAddToCartButton() {
    const addToCartButton = document.querySelector('.add-to-cart');
    const quantityInput = document.querySelector('.quantity');
    const optionRadios = document.querySelectorAll('input[name="option"]');
    
    if (addToCartButton) {
        addToCartButton.addEventListener('click', () => {
            const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
            
            const selectedOption = Array.from(optionRadios).find(radio => radio.checked);
            if (selectedOption) {
                const productId = parseInt(addToCartButton.dataset.productId);
                const variationId = parseInt(selectedOption.value);
                
                addToCart(productId, quantity, variationId);
            } else {
                alert('Моля, изберете опция за продукта.');
            }
        });
    } else {
        console.error("Add to Cart button not found.");
    }
}
// Add this line to wait for the page to load before setting up the button
document.addEventListener('DOMContentLoaded', setupAddToCartButton);