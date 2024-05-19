// JavaScript
function toggleMenu() {
    var menu = document.getElementById("menu");
    if (menu.classList.contains("hidden")) {
      menu.classList.remove("hidden");
      menu.classList.add("visible");
    } else {
      menu.classList.remove("visible");
      menu.classList.add("hidden");
    }
  }
  
  function toggleRotation() {
    var button = document.getElementById('main-button');
    button.classList.toggle('rotated'); // Agrega o quita la clase 'rotated' al hacer clic
}