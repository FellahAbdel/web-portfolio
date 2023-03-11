const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
});
