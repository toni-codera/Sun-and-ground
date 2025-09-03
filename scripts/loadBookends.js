document.addEventListener('DOMContentLoaded', () => {
    const productLinks = document.querySelectorAll('.product');

    productLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default link behavior
            
            // Get the ID from the dataset.
            const productId = link.dataset.id;
            
            // Store the selected product ID in local storage.
            localStorage.setItem('selectedProductId', productId); 
            
            // Navigate to the product page with the correct ID in the URL.
            window.location.href = '/Sun_and_ground/productPage/' + productId;
        });
    });
});

// Redirect to Terms & Policies on click
const terms = document.querySelector('.js-terms');
if (terms) {
    terms.addEventListener('click', () => {
        window.location.href = 'policyAndTerms.html';
    });
}

// Redirect to Delivery page on click
const delivery = document.querySelector('.js-delivery');
if (delivery) {
    delivery.addEventListener('click', () => {
        window.location.href = 'delivery.html';
    });
}