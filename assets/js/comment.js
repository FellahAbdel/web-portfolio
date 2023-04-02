const form = document.querySelector("form");
const usernameElt = document.getElementById("surname");
const userMessageElt = document.getElementById("user-msg");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  if (checkInputs()) {
    showSuccessfullMsg();
    const formData = new FormData(form);

    fetch(form.action, {
      method: "GET",
      body: formData,
    })
      .then((response) => {
        // Handle the response from the server
        // ...
        // Clear the form inputs
        // form.reset();
      })
      .catch((error) => {
        console.error(error);
      });
  } else {
    hideSuccesfullMsg();
  }
});

function checkInputs() {
  // get the values from the inputs
  let allInputsValid = true;
  const usernameValue = usernameElt.value.trim();
  const userMessage = userMessageElt.value.trim();
  if (usernameValue === "") {
    // show error
    // add error class
    allInputsValid = false;
    setErrorFor(usernameElt, "First name cannot be blank");
  } else {
    // add sucess class
    setSuccessFor(usernameElt);
  }

  if (userMessage === "") {
    allInputsValid = false;
    setErrorFor(userMessageElt, "Message number cannot be blank.");
  } else if (userMessage.length > 200) {
    allInputsValid = false;
    setErrorFor(userMessageElt, "At least 200 characters");
  } else {
    setSuccessFor(userMessageElt);
  }

  return allInputsValid;
}

function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");

  // Add error message inside small
  small.innerText = message;
  formControl.className = "form-control error";
}

function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = "form-control success";
}

function showSuccessfullMsg() {
  const smallElt = document.querySelector("form div~small");
  smallElt.style.visibility = "visible";
}

function hideSuccesfullMsg() {
  const smallElt = document.querySelector("form div~small");
  smallElt.style.visibility = "hidden";
}
