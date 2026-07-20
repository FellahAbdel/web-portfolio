const themeSelect = document.getElementById("theme");

if (themeSelect) {
  themeSelect.value = document.documentElement.getAttribute("data-theme") || "dark";

  themeSelect.addEventListener("change", (event) => {
    const theme = event.target.value;
    document.documentElement.setAttribute("data-theme", theme);
    try {
      localStorage.setItem("theme", theme);
    } catch (e) {
      // localStorage indisponible (navigation privée, etc.) : le thème ne sera pas mémorisé.
    }
  });
}
