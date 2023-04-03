const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");
const bodyElt = document.querySelector("body");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  bodyElt.classList.toggle("scrollOff");
});
