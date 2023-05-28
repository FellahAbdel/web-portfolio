<form action="/assets/php/insert.php" method="post">
  <div class="form-control">
    <label for="title"><?= $trad["AdminProjectForm"]["project title"] ?></label>
    <input type="text" name="project-title" id="title" placeholder="<?= $trad["AdminProjectForm"]["project title"] ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="description"><?= $trad["AdminProjectForm"]["description"] ?></label>
    <textarea name="description" id="description" cols="30" rows="9" placeholder="<?= $trad["AdminProjectForm"]["description"] ?>"></textarea>
    <small>Error message</small>
  </div>
  <div class="file-upload-wrapper" data-text="<?= $trad["AdminProjectForm"]["project image"] ?>">
    <input name="file-upload-field" type="file" class="file-upload-field" value="">
  </div>
  <small>Project has been successfully added!</small>
  <button><?= $trad["AdminProjectForm"]["upload button"] ?></button>
</form>