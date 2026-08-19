<li class="project-card admin-project-card">
  <div class="project-image-wrapper">
    <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" loading="lazy" />
    <div class="project-overlay">
      <a href="/projectItem.php?id=<?= $project["id"] ?>" class="btn-view-project" target="_blank">
        <?= $trad["projectSection"]["viewButton"] ?> <i class="mdi mdi-arrow-right"></i>
      </a>
    </div>
  </div>
  <div class="project-content">
    <div class="project-header">
      <h3><?= $project["title"] ?></h3>
      <span class="admin-project-id">#<?= $project["id"] ?></span>
    </div>
    <p>
      <?= htmlspecialchars_decode(substr($project["description"], 0, 120)) ?>...
    </p>
    <div class="admin-project-actions">
      <a href="/admin/update.php?id=<?= $project["id"] ?>" class="admin-action-btn admin-action-edit">
        <i class="mdi mdi-pencil"></i>
        <span><?= $trad["adminActions"]["edit"] ?></span>
      </a>
      <a href="/projectItem.php?id=<?= $project["id"] ?>" class="admin-action-btn admin-action-view" target="_blank">
        <i class="mdi mdi-arrow-top-right"></i>
        <span><?= $trad["projectSection"]["viewButton"] ?></span>
      </a>
      <a href="/admin/delete.php?id=<?= $project["id"] ?>" class="admin-action-btn admin-action-delete">
        <i class="mdi mdi-delete"></i>
      </a>
    </div>
  </div>
</li>