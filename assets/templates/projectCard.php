<li class="project-card">
  <a href="/projectItem.php?id=<?= $project["id"] ?>" class="project-link-wrapper">
    <div class="project-image-wrapper">
      <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" loading="lazy" />
      <div class="project-overlay">
        <span class="btn-view-project">
          <?= $trad["projectSection"]["viewButton"] ?> <i class="mdi mdi-arrow-right"></i>
        </span>
      </div>
    </div>
    <div class="project-content">
      <div class="project-header">
        <h3><?= $project["title"] ?></h3>
        <i class="mdi mdi-arrow-top-right project-arrow"></i>
      </div>
      <p>
        <?= htmlspecialchars_decode(substr($project["description"], 0, 120)) ?>...
      </p>
      <!-- Placeholder pour les tags (à dynamiser plus tard si possible) -->
      <div class="project-tags">
        <span class="tag">Web</span>
        <span class="tag">Dev</span>
      </div>
    </div>
  </a>
</li>