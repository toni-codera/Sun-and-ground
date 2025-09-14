document.addEventListener('DOMContentLoaded', () => {
    const productLinks = document.querySelectorAll('.product');

    productLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const productId = link.dataset.id;
            localStorage.setItem('selectedProductId', productId); 
            window.location.href = '/Sun_and_ground/productPage/' + productId;
        });
    });
});

const terms = document.querySelector('.js-terms');
if (terms) {
    terms.addEventListener('click', () => {
        window.location.href = 'policyAndTerms.html';
    });
}

const delivery = document.querySelector('.js-delivery');
if (delivery) {
    delivery.addEventListener('click', () => {
        window.location.href = 'delivery.html';
    });
}