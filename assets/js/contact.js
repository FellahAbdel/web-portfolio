import {
  setErrorFor,
  setSuccessFor,
  showSuccessfullMsg,
  hideSuccesfullMsg,
  removeSuccess,
} from "./shared-comment-contact.js";

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

// //* Pour la validation des données de l'utilisateur avant envoi.

const form = document.querySelector("form");
const usernameElt = document.getElementById("surname");
const emailElt = document.getElementById("email");
const phoneNumberElt = document.getElementById("phone-number");
const userMessageElt = document.getElementById("user-msg");

const elements = [usernameElt, emailElt, phoneNumberElt, userMessageElt];

form.addEventListener("submit", (e) => {
  e.preventDefault();

  if (checkInputs()) {
    showSuccessfullMsg();
    const formData = new FormData(form);

    fetch(form.action, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // Handle the response from the server
        // ...
        // Clear the form inputs
        elements.forEach((element) => removeSuccess(element));
        // removeSuccess();
        form.reset();
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
  const emailValue = emailElt.value.trim();
  const phoneNumberValue = phoneNumberElt.value.trim();
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

  if (emailValue === "") {
    allInputsValid = false;
    setErrorFor(emailElt, "Email cannot be blank.");
  } else if (!emailCheck(emailValue)) {
    setErrorFor(emailElt, "Email is not valid");
  } else {
    setSuccessFor(emailElt);
  }

  if (phoneNumberValue === "") {
    allInputsValid = false;
    setErrorFor(phoneNumberElt, "Phone number cannot be blank.");
  } else if (!phoneNumberCheck(phoneNumberValue)) {
    allInputsValid = false;
    setErrorFor(phoneNumberElt, "Phone number is not valid.");
  } else {
    setSuccessFor(phoneNumberElt);
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

const emailCheck = (email) =>
  /[a-zA-Z0-9-._]+@[a-zA-Z0-9-._]+\.[a-z]{2,}/.test(email);

const phoneNumberCheck = (phoneNumber) => /^\d{10}$/.test(phoneNumber);
