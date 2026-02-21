function stripHtmlTags(html) {
  var doc = new DOMParser().parseFromString(html, "text/html");
  return doc.body.textContent || "";
}

var start = 3; // Initialement 3 projets chargés par PHP
var count = 3; // On charge 3 par 3 ensuite

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
        // Nouveau template HTML correspondant à projectCard.php
        const html = `
          <li class="project-card">
            <a href="/projectItem.php?id=${project.id}" class="project-link-wrapper">
              <div class="project-image-wrapper">
                <img src="/public/uploads/${project.imageName}" alt="${project.imageAlt}" loading="lazy" />
                <div class="project-overlay">
                  <span class="btn-view-project">
                    Voir <i class="mdi mdi-arrow-right"></i>
                  </span>
                </div>
              </div>
              <div class="project-content">
                <div class="project-header">
                  <h3>${project.title}</h3>
                  <i class="mdi mdi-arrow-top-right project-arrow"></i>
                </div>
                <p>
                  ${stripHtmlTags(project.description).substring(0, 120)}...
                </p>
                <div class="project-tags">
                  <span class="tag">Web</span>
                  <span class="tag">Dev</span>
                </div>
              </div>
            </a>
          </li>
        `;
        
        const projectsList = document.querySelector("#projects ul");
        if (projectsList) {
            projectsList.insertAdjacentHTML("beforeend", html);
        }
      });

      // Update start index for next fetch call
      start += count;
      
      // Vérification si tous les projets sont chargés
      if (extractedValue && start >= extractedValue) {
        hideLoadButton();
      }
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}

const loadBtn = document.querySelector("#projects ul ~ button");

if (loadBtn) {
    // Observer pour le chargement infini
    const options = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1, // Déclencher un peu avant que le bouton soit totalement visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // On vérifie si on n'a pas déjà tout chargé
                if (!extractedValue || start < extractedValue) {
                    loadMore();
                } else {
                    hideLoadButton();
                }
            }
        });
    }, options);

    observer.observe(loadBtn);

    loadBtn.onclick = () => {
        loadMore();
    };
}

let extractedValue;

async function fetchProjects() {
  try {
    const response = await fetch("assets/php/projectTableSize.php");
    if (response.ok) {
        const data = await response.json();
        extractedValue = data;
        // Si on a déjà tout affiché au chargement initial
        if (start >= extractedValue) {
            hideLoadButton();
        }
    }
  } catch (error) {
    console.error(error);
  }
}

function hideLoadButton() {
  if (loadBtn) {
    loadBtn.style.display = "none";
  }
}

// Initialisation
fetchProjects();
