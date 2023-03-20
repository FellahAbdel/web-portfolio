var start = 3;
var count = getProjectCount();

function getProjectCount() {
  // Return different project count based on screen size
  if (window.innerWidth >= 768) {
    // Desktop and tablet
    return 3;
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
                      <img src="/assets/images/projects/${
                        project.imageName
                      }" alt="" />
                      <article>
                        <div>
                          <h2>${project.title}</h2>
                          <p>${project.description.substring(0, 300)}</p>
                        </div>
                        <footer>
                          <a href="projectItem.php?id=${
                            project.id
                          }">explore -></a>
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

window.addEventListener("scroll", function () {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadMore();
  }
});

document.addEventListener("DOMContentLoaded", function () {
  loadMore();
});
