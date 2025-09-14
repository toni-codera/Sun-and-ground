document.addEventListener('DOMContentLoaded', () => {
    attachCartItemEventListeners();

    const confirmOrderButton = document.getElementById('confirm-order-button');
    const confirmationContainer = document.getElementById('confirmation-container');
    const confirmNoButton = document.querySelector('.confirm-no-button');

    if (confirmOrderButton && confirmationContainer && confirmNoButton) {
        confirmOrderButton.addEventListener('click', () => {
            confirmationContainer.classList.remove('hidden');
            confirmOrderButton.classList.add('hidden');
        });

        confirmNoButton.addEventListener('click', () => {
            confirmationContainer.classList.add('hidden');
            confirmOrderButton.classList.remove('hidden');
        });
    }
});

function attachCartItemEventListeners() {
    const itemsContainer = document.querySelector('.cart-container');
    if (!itemsContainer) return;

    itemsContainer.addEventListener('click', async (event) => {
        const itemDisplay = event.target.closest('.cart-item-display');
        if (!itemDisplay) return;

        const cartItemId = itemDisplay.dataset.cartItemId;
        const quantityInput = itemDisplay.querySelector('.cart-item-quantity');

        if (event.target.closest('.cart-delete-item')) {
            await deleteItem(cartItemId, itemDisplay);
            return;
        }

        if (event.target.closest('.quantity-button.minus')) {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                await updateQuantity(cartItemId, quantityInput.value);
            }
        } else if (event.target.closest('.quantity-button.plus')) {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < parseInt(quantityInput.max)) {
                quantityInput.value = currentValue + 1;
                await updateQuantity(cartItemId, quantityInput.value);
            }
        }
    });

    itemsContainer.addEventListener('change', async (event) => {
        const quantityInput = event.target.closest('.cart-item-quantity');
        if (!quantityInput) return;

        const itemDisplay = quantityInput.closest('.cart-item-display');
        const cartItemId = itemDisplay.dataset.cartItemId;

        let value = parseInt(quantityInput.value);
        const min = parseInt(quantityInput.min);
        const max = parseInt(quantityInput.max);

        if (isNaN(value) || value < min) {
            quantityInput.value = min;
        } else if (value > max) {
            quantityInput.value = max;
        }
        await updateQuantity(cartItemId, quantityInput.value);
    });
}

async function deleteItem(cartItemId, itemDisplayElement) {
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('cart_item_id', cartItemId);

    try {
        const response = await fetch('/Sun_and_ground/includes/cart.inc.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        if (result.success) {
            itemDisplayElement.remove();
            updateCartTotals();
        } else {
            console.error('Failed to delete item:', result.error);
        }
    } catch (error) {
        console.error('Error deleting item:', error);
    }
}

async function updateQuantity(cartItemId, newQuantity) {
    const formData = new FormData();
    formData.append('action', 'update_quantity');
    formData.append('cart_item_id', cartItemId);
    formData.append('quantity', newQuantity);

    try {
        const response = await fetch('/Sun_and_ground/includes/cart.inc.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        if (result.success) {
            updateCartTotals();
        } else {
            console.error('Failed to update quantity:', result.error);
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
    }
}

function updateCartTotals() {
    location.reload();
}