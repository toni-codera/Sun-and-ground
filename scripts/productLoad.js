document.addEventListener('DOMContentLoaded', () => {
    // Attach event listeners after the DOM is fully loaded
    attachAddToCartEventListeners();
});

function attachAddToCartEventListeners() {
    // Find the "Add to Cart" button
    const addToCartButton = document.querySelector('.add-to-cart');

    // If the button exists, attach a click event listener
    if (addToCartButton) {
        addToCartButton.addEventListener('click', async () => {
            // Get the selected product variation ID from a hidden input or data attribute
            // You might need to adjust this selector based on your HTML
            const selectedVariation = document.querySelector('input[name="option"]:checked');
            if (!selectedVariation) {
                alert('Моля, изберете вариант на продукта.'); // Please select a product variation.
                return;
            }
            const productVariationId = selectedVariation.value;
            await addToCart(productVariationId);
        });
    }
}

async function addToCart(productVariationId) {
    const formData = new FormData();
    formData.append('action', 'add');
    formData.append('product_variation_id', productVariationId);
    formData.append('quantity', 1);

    try {
        const response = await fetch('/Sun_and_ground/includes/cart.inc.php', {
            method: 'POST',
            body: formData,
        });

        // This is the key part that handles unauthenticated users
        if (!response.ok) {
            if (response.status === 401) {
                // This line will trigger the PHP redirect to login.php
                // for the main page, not for the AJAX request.
                location.reload(); 
                return;
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        
        if (result.success) {
            alert("Продуктът е добавен в количката!"); 
        } else {
            console.error('Failed to add item to cart:', result.error);
            alert("Възникна грешка при добавянето на продукта.");
        }
    } catch (error) {
        console.error('Error adding item to cart:', error);
        alert("Възникна грешка при свързването със сървъра.");
    }
}