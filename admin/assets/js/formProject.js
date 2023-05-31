const scriptElements = document.scripts;
const currentScript = scriptElements[scriptElements.length - 1];
const scriptSrc = currentScript.src;
const urlParams = new URLSearchParams(scriptSrc.split("?")[1]);
const fileName = urlParams.get("fileName") || "";

import {
  setErrorFor,
  setSuccessFor,
  showSuccessfullMsg,
  hideSuccesfullMsg,
  removeSuccess,
} from "../../../assets/js/shared-comment-contact.js";

let isInsertPage = false;
if (fileName === "insert") {
  isInsertPage = true;
}

export function setErrorSpecif(input, message, isInsertPage) {
  if (isInsertPage) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");

    // Add error message inside small
    small.innerText = message;
    formControl.className = "file-upload-wrapper error";
  }
}
export function setSuccessSpecif(input, isInsertPage) {
  if (isInsertPage) {
    const formControl = input.parentElement;
    formControl.className = "file-upload-wrapper success";
  }
}
const formElt = document.querySelector("form");
const projectTitleElt = document.getElementById("project-title");
const projectDescriptionElt = document.getElementById("description");
const textAltImageElt = document.getElementById("text-alt");
const fileUploadWrapper = document.querySelector(".file-upload-wrapper");
const textPrompt = fileUploadWrapper.getAttribute("data-text");
const projectImageElt = document.querySelector(".file-upload-field");

let projectTitleValue;
let projectDescriptionValue;
let projectImageValue;
let textAltImageValue;

const elements = [
  projectTitleElt,
  projectDescriptionElt,
  textAltImageElt,
  projectImageElt,
];

formElt.addEventListener("change", function (event) {
  // Update the field with the uploaded image name.
  var fileName = projectImageElt.value.replace(/.*(\/|\\)/, "");
  fileUploadWrapper.setAttribute("data-text", fileName);
});

formElt.addEventListener("submit", (event) => {
  event.preventDefault();

  // Vérification des données.
  if (checkInputs()) {
    showSuccessfullMsg();
    const formData = new FormData(formElt);

    fetch(formElt.action, {
      mode: "no-cors",
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // Handle the response from the server
        // ...
        // Clear the form inputs
        elements.forEach((element) => removeSuccess(element));
        // removeSuccess();
        formElt.reset();
        fileUploadWrapper.setAttribute("data-text", textPrompt);
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
  projectTitleValue = projectTitleElt.value.trim();
  projectDescriptionValue = projectDescriptionElt.value.trim();
  textAltImageValue = textAltImageElt.value.trim();
  projectImageValue = projectImageElt.value.trim();

  if (projectTitleValue === "") {
    // show error
    // add error class
    allInputsValid = false;
    setErrorFor(projectTitleElt, "Project title cannot be blank");
  } else {
    // add sucess class
    setSuccessFor(projectTitleElt);
  }

  if (projectDescriptionValue === "") {
    allInputsValid = false;
    setErrorFor(projectDescriptionElt, "Project description cannot be blank.");
  } else if (projectDescriptionValue.length < 100) {
    allInputsValid = false;
    setErrorFor(projectDescriptionElt, "At least 100 characters");
  } else {
    setSuccessFor(projectDescriptionElt);
  }

  if (textAltImageValue === "") {
    allInputsValid = false;
    setErrorFor(textAltImageElt, "Alternative text cannot be blank.");
  } else {
    setSuccessFor(textAltImageElt);
  }

  if (projectImageValue === "") {
    allInputsValid = false;
    setErrorSpecif(projectImageElt, "Project image is required.", isInsertPage);
    if (!isInsertPage) {
      allInputsValid = true;
    }
  } else {
    setSuccessSpecif(projectImageElt, isInsertPage);
  }

  return allInputsValid;
}
