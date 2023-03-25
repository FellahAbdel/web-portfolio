//* C'est repetitif, il faudra penser à trouver un autre moyen plus compacte
const hamburger = document.querySelector("header div");
const navMenu = document.querySelector("header ul");
const main = document.querySelector("main");
const footer = document.querySelector("footer");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  main.classList.toggle("hide");
  footer.classList.toggle("hide");
});

//* Submit button
submitBtn = document.querySelector("form button");
submitBtn.addEventListener("click", (event) => {
  event.preventDefault();
});
