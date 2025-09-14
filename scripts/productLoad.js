document.addEventListener('DOMContentLoaded', () => {
    attachAddToCartEventListeners();
});

function attachAddToCartEventListeners() {
    const addToCartButton = document.querySelector('.add-to-cart');

    if (addToCartButton) {
        addToCartButton.addEventListener('click', async () => {
            const selectedVariation = document.querySelector('input[name="option"]:checked');
            if (!selectedVariation) {
                alert('Моля, изберете вариант на продукта.'); 
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
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            if (response.status === 401) {
                alert("Трябва да сте влезли в профила си, за да добавите продукти в количката."); 
                window.location.href = '/Sun_and_ground/login.php';
                return;
            }
            throw new Error(`HTTP error! Status: ${response.status}`);
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