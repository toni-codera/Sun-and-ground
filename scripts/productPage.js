import { generateProductHtml } from "./productLoad.js";

document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.querySelector('.js-main-content');
    const selectedProductId = localStorage.getItem('selectedProductId');

    if (selectedProductId) {
        mainContent.innerHTML = generateProductHtml(selectedProductId);
        // You might want to remove the item from localStorage after use if it's a one-time display
        // localStorage.removeItem('selectedProductId'); 
    } else {
        mainContent.innerHTML = '<h1>No product selected. Please go back to the home page and select a product.</h1>';
        console.warn("No product ID found in localStorage for productPage.html");
    }
});