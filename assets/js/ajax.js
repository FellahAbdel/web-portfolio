var start = 0;
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
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Parse JSON response
      var projects = JSON.parse(xhr.responseText);

      // Append projects to container element
      projects.forEach(function (project) {
        const html = `
                    <li>
                      <img src="/assets/images/projects/web6.jpg" alt="" />
                      <article>
                        <div>
                          <h2>${project.title}</h2>
                          <p>${project.description.substring(0, 300)}</p>
                        </div>
                        <footer>
                          <a href="/">explore -></a>
                        </footer>
                      </article>
                    </li>
                    `;
        document
          .querySelector("#projects ul")
          .insertAdjacentHTML("beforeend", html);
      });

      // Update start index for next AJAX call
      start += count;
    }
  };

  xhr.open(
    "GET",
    "assets/models/getProjects.php?start=" + start + "&count=" + count,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send();
}

window.addEventListener("scroll", function () {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadMore();
  }
});

document.addEventListener("DOMContentLoaded", function () {
  loadMore();
});
