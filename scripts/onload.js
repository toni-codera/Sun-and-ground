function loadContent(file){
fetch(file)
.then(response =>response.text())
.then(data => document.querySelector(".js-main-content").innerHTML = data)
.catch(error =>console.error('Error loading content:', error));
}
loadContent('home.html')