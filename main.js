const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");
const home = document.getElementById("home");
const frontPage = document.querySelector("section:first-child");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  home.classList.toggle("change-top");
  frontPage.classList.toggle("change-height");
});
