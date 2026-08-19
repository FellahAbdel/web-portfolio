<div class="form-page-layout">

  <!-- En-tête de la page -->
  <div class="form-page-header">
    <a href="/admin/index.php" class="form-back-link">
      <i class="mdi mdi-arrow-left"></i>
      <?= $trad["AdminProjectForm"]["go-back-btn"] ?>
    </a>
    <div class="form-page-title">
      <h1><?= $trad["adminPageTitle"][isset($title) ? "update" : "insert"] ?></h1>
      <p><?= isset($title) ? $trad["AdminProjectForm"]["edit-subtitle"] ?? "Modifiez les informations du projet." : $trad["AdminProjectForm"]["insert-subtitle"] ?? "Remplissez les informations du nouveau projet." ?></p>
    </div>
  </div>

  <!-- Formulaire principal -->
  <form role="form" class="project-form glass-panel" action="/admin/assets/actions/<?php echo $fileHandler; ?>" method="post" enctype="multipart/form-data">

    <!-- Colonne principale -->
    <div class="form-main-col">

      <!-- Titre -->
      <div class="form-control">
        <label for="project-title">
          <i class="mdi mdi-format-title form-label-icon"></i>
          <?= $trad["AdminProjectForm"]["project title"] ?>
          <span class="form-required">*</span>
        </label>
        <input
          type="text"
          name="project-title"
          id="project-title"
          placeholder="<?= $trad["AdminProjectForm"]["project title"] ?>"
          value="<?php echo isset($title) ? $title : ''; ?>"
          autocomplete="off"
        />
        <i class="mdi mdi-check-circle-outline"></i>
        <i class="mdi mdi-alert-circle"></i>
        <small>Error message</small>
      </div>

      <!-- Description -->
      <div class="form-control">
        <label for="description">
          <i class="mdi mdi-text-long form-label-icon"></i>
          <?= $trad["AdminProjectForm"]["description"] ?>
          <span class="form-required">*</span>
        </label>
        <textarea
          name="description"
          id="description"
          rows="10"
          placeholder="<?= $trad["AdminProjectForm"]["description"] ?>"
        ><?php echo isset($description) ? $description : ''; ?></textarea>
        <small>Error message</small>
      </div>

      <!-- Texte alternatif -->
      <div class="form-control">
        <label for="text-alt">
          <i class="mdi mdi-image-text form-label-icon"></i>
          <?= $trad["AdminProjectForm"]["text alt"] ?>
          <span class="form-required">*</span>
        </label>
        <input
          type="text"
          name="text-alt"
          id="text-alt"
          placeholder="<?= $trad["AdminProjectForm"]["text alt"] ?>"
          value="<?php echo isset($textAlt) ? $textAlt : ''; ?>"
          autocomplete="off"
        />
        <i class="mdi mdi-check-circle-outline"></i>
        <i class="mdi mdi-alert-circle"></i>
        <small>Error message</small>
      </div>

    </div><!-- /.form-main-col -->

    <!-- Colonne image (sidebar) -->
    <div class="form-side-col">

      <!-- Aperçu image actuelle (mode édition) -->
      <?php if (isset($imageName)) { ?>
        <div class="form-image-preview glass-panel">
          <p class="form-section-label">
            <i class="mdi mdi-image-outline"></i>
            <?= $trad["AdminProjectForm"]["current-image"] ?? "Image actuelle" ?>
          </p>
          <img src="/public/uploads/<?php echo $imageName; ?>" alt="<?php echo isset($textAlt) ? $textAlt : ''; ?>" id="image-preview-current" />
        </div>
      <?php } else { ?>
        <div class="form-image-preview glass-panel" id="image-preview-wrapper" style="display:none;">
          <p class="form-section-label">
            <i class="mdi mdi-image-outline"></i>
            <?= $trad["AdminProjectForm"]["preview"] ?? "Aperçu" ?>
          </p>
          <img src="" alt="preview" id="image-preview-new" />
        </div>
      <?php } ?>

      <!-- Upload image -->
      <div class="form-section-card glass-panel">
        <p class="form-section-label">
          <i class="mdi mdi-upload-outline"></i>
          <?= $trad["AdminProjectForm"]["project image"] ?>
          <?php if (!isset($imageName)) { ?><span class="form-required">*</span><?php } ?>
        </p>
        <div class="file-upload-wrapper" data-text="<?= $trad["AdminProjectForm"]["project image"] ?>">
          <input name="file-upload-field" type="file" class="file-upload-field" value="" accept="image/*" />
          <div class="file-upload-ui">
            <i class="mdi mdi-cloud-upload-outline file-upload-icon"></i>
            <span class="file-upload-label"><?= $trad["AdminProjectForm"]["project image"] ?></span>
            <span class="file-upload-hint">PNG, JPG, WEBP</span>
          </div>
          <small>Error message</small>
        </div>
      </div>

    </div><!-- /.form-side-col -->

    <!-- Actions du formulaire -->
    <div class="form-actions">
      <button type="submit" class="btn-submit">
        <i class="mdi mdi-<?= isset($title) ? 'content-save-outline' : 'plus-circle-outline' ?>"></i>
        <?php echo $trad["AdminProjectForm"][$button]; ?>
      </button>
    </div>

  </form>

</div><!-- /.form-page-layout -->

<?php if (!isset($imageName)) { ?>
<script>
  // Aperçu de l'image sélectionnée (mode création)
  document.querySelector('.file-upload-field').addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const wrapper = document.getElementById('image-preview-wrapper');
        const img = document.getElementById('image-preview-new');
        img.src = e.target.result;
        wrapper.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
</script>
<?php } ?>