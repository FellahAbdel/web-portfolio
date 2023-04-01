const scriptSrc = document.currentScript.src;
const urlParams = new URLSearchParams(scriptSrc.split("?")[1]);
const parentName = urlParams.get("parent") || "";

const langSelect = document.getElementById("lang");

langSelect.addEventListener("change", (event) => {
  const selectedValue = event.target.value;
  let url = "/" + parentName;

  const regex = /\/projectItem\.php\?id=[0-9]+/i;
  if (regex.test(window.location.href)) {
    url = window.location.href.match(regex)[0] + "&lang=" + selectedValue;
  } else {
    url += "?lang=" + selectedValue;
  }

  //* We change here, the page url.
  window.location.href = url;
});
