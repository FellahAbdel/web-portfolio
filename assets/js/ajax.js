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
                          <p>${project.description.substring(0, 300)}</p>
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
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}

// window.addEventListener("scroll", function () {
//   if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
//     loadMore();
//   }
// });

const observer = new IntersectionObserver(
  (entries) => {
    const footerEntry = entries[0];
    const footerVisibleRatio = footerEntry.intersectionRatio;

    if (footerVisibleRatio >= 0.9) {
      loadMore();
    }
  },
  { threshold: 0.9 }
);

const footerElement = document.querySelector("footer");
observer.observe(footerElement);
