import { generateProductHtml, getProductFromList } from "../productLoad.js";
import { setupAddToCartButton } from "../cart.js"

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