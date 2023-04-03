import {
  setErrorFor,
  setSuccessFor,
  showSuccessfullMsg,
  hideSuccesfullMsg,
  removeSuccess,
} from "./shared-comment-contact.js";

const form = document.querySelector("form");
const usernameElt = document.getElementById("pseudo-name");
const userMessageElt = document.getElementById("user-msg");

let usernameValue;
let userMessageValue;
form.addEventListener("submit", (e) => {
  e.preventDefault();

  if (checkInputs()) {
    showSuccessfullMsg();
    const formData = new FormData(form);
    const projectId = getProjectIdFromUrl(); // get project ID from URL

    fetch(
      `${form.action}?id=${projectId}&pseudo-name=${encodeURIComponent(
        usernameValue
      )}&user-msg=${encodeURIComponent(userMessageValue)}`,
      {
        // include project ID in URL
        method: "GET",
      }
    )
      .then((response) => {
        // Handle the response from the server
        // ...
        // Clear the form inputs
        [usernameElt, userMessageElt].forEach((e) => removeSuccess(e));
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
  usernameValue = usernameElt.value.trim();
  userMessageValue = userMessageElt.value.trim();
  if (usernameValue === "") {
    // show error
    // add error class
    allInputsValid = false;
    setErrorFor(usernameElt, "First name cannot be blank");
  } else {
    // add sucess class
    setSuccessFor(usernameElt);
  }

  if (userMessageValue === "") {
    allInputsValid = false;
    setErrorFor(userMessageElt, "Message number cannot be blank.");
  } else if (userMessageValue.length > 200) {
    allInputsValid = false;
    setErrorFor(userMessageElt, "At least 200 characters");
  } else {
    setSuccessFor(userMessageElt);
  }

  return allInputsValid;
}

function getProjectIdFromUrl() {
  const urlParams = new URLSearchParams(window.location.search);
  const projectId = urlParams.get("id");
  return projectId;
}
