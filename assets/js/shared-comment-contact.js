export function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");

  // Add error message inside small
  small.innerText = message;
  formControl.className = "form-control error";
}

export function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = "form-control success";
}

export function showSuccessfullMsg() {
  const smallElt = document.querySelector("form div~small");
  smallElt.style.visibility = "visible";
}

export function hideSuccesfullMsg() {
  const smallElt = document.querySelector("form div~small");
  smallElt.style.visibility = "hidden";
}

export function removeSuccess(input) {
  const formControl = input.parentElement;
  formControl.classList.remove("success");
}
