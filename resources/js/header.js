// resources/js/header.js
document.getElementById("hamburger-icon").addEventListener("click", function() {
    const menu = document.getElementById("menu");

    // Alterna entre abrir y cerrar el menú
    if (menu.classList.contains("open")) {
        menu.classList.remove("open");
        menu.classList.add("closed");
    } else {
        menu.classList.remove("closed");
        menu.classList.add("open");
    }
});
