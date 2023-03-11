//* C'est repetitif, il faudra penser à trouver un autre moyen plus compacte
const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");
const mainDiv = document.querySelector("main > div");
const main = document.querySelector("main");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  mainDiv.classList.toggle("change-top");
  main.classList.toggle("change-height");
});
