import {
  setErrorFor,
  setSuccessFor,
  showSuccessfullMsg,
  hideSuccesfullMsg,
  removeSuccess,
} from "../../../assets/js/shared-comment-contact.js";

export function setErrorSpecif(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");

  // Add error message inside small
  small.innerText = message;
  console.log(small);
  formControl.className = "file-upload-wrapper error";
}

export function setSuccessSpecif(input) {
  const formControl = input.parentElement;
  formControl.className = "file-upload-wrapper success";
}

const formElt = document.querySelector("form");
const projectTitleElt = document.getElementById("project-title");
const projectDescriptionElt = document.getElementById("description");
const fileUploadWrapper = document.querySelector(".file-upload-wrapper");
const projectImageElt = document.querySelector(".file-upload-field");

let projectTitleValue;
let projectDescriptionValue;
let projectImageValue;

formElt.addEventListener("change", function (event) {
  // Update the field with the uploaded image name.
  fileUploadWrapper.setAttribute("data-text", fileName);
  var fileName = projectImageElt.value.replace(/.*(\/|\\)/, "");
});

formElt.addEventListener("submit", (event) => {
  event.preventDefault();

  // Vérification des données.
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
  projectTitleValue = projectTitleElt.value.trim();
  projectDescriptionValue = projectDescriptionElt.value.trim();

  projectImageValue = projectImageElt.value.trim();
  if (projectTitleValue === "") {
    // show error
    // add error class
    allInputsValid = false;
    setErrorFor(projectTitleElt, "Project title cannot be blank");
    console.log(projectTitleElt);
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

  if (projectImageValue === "") {
    allInputsValid = false;
    setErrorSpecif(projectImageElt, "Project image is required.");
  } else {
    setSuccessSpecif(projectImageElt);
  }

  return allInputsValid;
}
