import { html } from "./productLoad.js";


/*Change content in main section function */
function loadContent(file) {
  $.ajax({
    url: file,
    success: data=> {$('.js-main-content').html(data);},
    error: error => {console.error('Error loading content:', error);}
  });
}

/*Load main content onload*/
$(document).ready(()=>{
  loadContent('home.html');
});

/*Load main content on logo click*/

$(".js-logo").click(()=>{
  loadContent("home.html");
})

/*Products pop up*/

$('.product').click(function() {
  $('.js-main-content').html(html);
});

/*Login pop up*/
const blackBox = $(".js-black-box");
const loginForm = $(".js-login-form");
$(".js-login-container").click(()=>{
  loginForm.fadeIn(100);
  setTimeout(()=>{blackBox.addClass("black-box");},50)
});

/*Login pop out*/
function exitLogin(){
  loginForm.fadeOut(100);
  blackBox.removeClass("black-box")
}

blackBox.click(()=>{
  exitLogin();
});

$(document).keydown((event)=>{
  if(event.keyCode === 27){
    exitLogin();
  }
});
/*Register form pop up*/
$('.register').click(()=>{
  loadContent('registration.html');
  exitLogin();
});
/*Create registretion*/
$(document).ready(()=>{
  $(".register-button").click(()=>{
  loadContent('../home.html');
  console.log("awdijiawdjiijadwijadwijdawijawd")
});
})