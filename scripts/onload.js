import { html } from "../scripts/productLoad.js";
function loadContent(file){
fetch(file)
.then(response =>response.text())
.then(data => document.querySelector(".js-main-content").innerHTML = data)
.catch(error =>console.error('Error loading content:', error));
}

window.onload = ()=>{
   loadContent('home.html');
};


const logoLinks = document.querySelectorAll('.js-logo');

logoLinks.forEach(link => {
  link.addEventListener('click', () => {
    loadContent('home.html');
  });
});


const productLinks = document.querySelectorAll('.product')
productLinks.forEach(link =>{
  link.addEventListener('click',()=>{
   document.querySelector(".js-main-content").innerHTML = html;
});
});


$(".js-login-container").click(()=>{
  $(".js-login-form").fadeIn(100);
})

