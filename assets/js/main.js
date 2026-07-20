const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");

// Bloque le scroll de la page tant qu'un menu (nav mobile ou select custom)
// est ouvert. Exposé sur window pour que custom-select.js puisse l'appeler
// aussi quand un menu déroulant s'ouvre/se ferme.
function updateScrollLock() {
  const menuOpen = navMenu.classList.contains("active");
  const dropdownOpen = document.querySelector(".select-dropdown.is-open");
  document.documentElement.classList.toggle("no-scroll", Boolean(menuOpen || dropdownOpen));
}
window.updateScrollLock = updateScrollLock;

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  updateScrollLock();
});
