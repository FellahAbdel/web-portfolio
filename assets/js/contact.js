import {
  setErrorFor,
  setSuccessFor,
  showSuccessfullMsg,
  hideSuccesfullMsg,
  removeSuccess,
} from "./shared-comment-contact.js";

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
  const isFr =
    document.documentElement.lang === "fr" ||
    window.location.search.includes("lang=fr");

  // get the values from the inputs
  let allInputsValid = true;
  const usernameValue = usernameElt.value.trim();
  const emailValue = emailElt.value.trim();
  const phoneNumberValue = phoneNumberElt.value.trim();
  const userMessage = userMessageElt.value.trim();

  if (usernameValue === "") {
    allInputsValid = false;
    setErrorFor(
      usernameElt,
      isFr ? "Veuillez renseigner votre nom." : "Please enter your name."
    );
  } else {
    setSuccessFor(usernameElt);
  }

  if (emailValue === "") {
    allInputsValid = false;
    setErrorFor(
      emailElt,
      isFr ? "Veuillez renseigner votre email." : "Email cannot be blank."
    );
  } else if (!emailCheck(emailValue)) {
    allInputsValid = false;
    setErrorFor(
      emailElt,
      isFr ? "Adresse email non valide." : "Email is not valid."
    );
  } else {
    setSuccessFor(emailElt);
  }

  if (phoneNumberValue === "") {
    allInputsValid = false;
    setErrorFor(
      phoneNumberElt,
      isFr ? "Veuillez renseigner votre numéro de téléphone." : "Phone number cannot be blank."
    );
  } else if (!phoneNumberCheck(phoneNumberValue)) {
    allInputsValid = false;
    setErrorFor(
      phoneNumberElt,
      isFr ? "Numéro de téléphone non valide." : "Phone number is not valid."
    );
  } else {
    setSuccessFor(phoneNumberElt);
  }

  if (userMessage === "") {
    allInputsValid = false;
    setErrorFor(
      userMessageElt,
      isFr ? "Veuillez décrire votre projet ou besoin." : "Please describe your project or need."
    );
  } else if (userMessage.length < 5) {
    allInputsValid = false;
    setErrorFor(
      userMessageElt,
      isFr ? "Votre message doit comporter au moins 5 caractères." : "Please enter at least 5 characters."
    );
  } else {
    setSuccessFor(userMessageElt);
  }

  return allInputsValid;
}

const emailCheck = (email) =>
  /^[a-zA-Z0-9-._]+@[a-zA-Z0-9-._]+\.[a-z]{2,}$/.test(email);

const phoneNumberCheck = (phoneNumber) =>
  /^[0-9+ \.\-\(\)]{7,30}$/.test(phoneNumber.trim());
