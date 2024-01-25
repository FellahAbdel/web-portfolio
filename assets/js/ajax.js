function stripHtmlTags(html) {
  var doc = new DOMParser().parseFromString(html, "text/html");
  return doc.body.textContent || "";
}
// var start = 3;
var start = getProjectCount(); //* Are the same
var count = getProjectCount();

function getProjectCount() {
  // Return different project count based on screen size
  if (window.innerWidth >= 1140) {
    // Desktop
    return 3;
  } else if (window.innerWidth >= 742) {
    // tablet
    return 2;
  } else {
    // Mobile phone
    return 1;
  }
}

function loadMore() {
  fetch("assets/models/getProjects.php?start=" + start + "&count=" + count)
    .then(function (response) {
      if (response.ok) {
        return response.json();
      }
      throw new Error("Network response was not ok.");
    })
    .then(function (projects) {
      // Append projects to container element
      projects.forEach(function (project) {
        const html = `
                    <li>
                      <img src="/public/uploads/${project.imageName}" alt="${
          project.imageAlt
        }" />
                      <article>
                        <div>
                          <h2>${project.title}</h2>
                          <p>${stripHtmlTags(project.description).substring(
                            0,
                            350
                          )}...</p>
                        </div>
                        <footer>
                          <a href="projectItem.php?id=${
                            project.id
                          }">explore <i class="mdi mdi-arrow-right-thick" ></i></a>
                        </footer>
                      </article>
                    </li>
                    `;
        document
          .querySelector("#projects ul")
          .insertAdjacentHTML("beforeend", html);
      });

      // Update start index for next fetch call
      start += count;
      if (areAllProjectsLoaded()) {
        hideLoadButton();
      }
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}

const loadBtn = document.querySelector("#projects ul ~ button");

(function () {
  // Observe loadBtn
  const options = {
    // Use the whole screen as scroll area
    root: null,
    // Do not grow or shrink the root area
    rootMargin: "0px",
    // Threshold of 1.0 will fire callback when 100% of element is visible
    threshold: 1.0,
  };

  const observer = new IntersectionObserver((entries) => {
    // Callback to be fired
    entries.forEach((entry) => {
      // Only add to list if element is coming into view not leaving
      if (entry.isIntersecting) {
        loadMore();
      }
    });
  }, options);

  observer.observe(loadBtn);
})();

loadBtn.onclick = () => {
  loadMore();
};

let extractedValue;

async function fetchProjects() {
  try {
    const response = await fetch("assets/php/projectTableSize.php");
    const data = await response.json();
    extractedValue = data;
  } catch (error) {
    console.error(error);
  }
}

function areAllProjectsLoaded() {
  // Return true if all projects are loaded, false otherwise
  return start >= extractedValue;
}

function hideLoadButton() {
  loadBtn.style.display = "none";
}

fetchProjects();
