<form role="form" action="/admin/assets/actions/<?php echo $fileHandler; ?>" method="post" enctype="multipart/form-data">
  <div class="form-control">
    <label for="project-title"><?= $trad["AdminProjectForm"]["project title"] ?></label>
    <input type="text" name="project-title" id="project-title" placeholder="<?= $trad["AdminProjectForm"]["project title"] ?>" value="<?php echo isset($title) ? $title : ''; ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="description"><?= $trad["AdminProjectForm"]["description"] ?></label>
    <textarea name="description" id="description" cols="30" rows="9" placeholder="<?= $trad["AdminProjectForm"]["description"] ?>"><?php echo isset($description) ? $description : ''; ?></textarea>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="text-alt"><?= $trad["AdminProjectForm"]["text alt"] ?></label>
    <input type="text" name="text-alt" id="text-alt" placeholder="<?= $trad["AdminProjectForm"]["text alt"] ?>" value="<?php echo isset($textAlt) ? $textAlt : ''; ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <?php if (isset($imageName)) { ?>
    <img width="100px" src="/public/uploads/<?php echo $imageName; ?>" alt="">
  <?php } ?>

  <div class="file-upload-wrapper" data-text="<?= $trad["AdminProjectForm"]["project image"] ?>">
    <input name="file-upload-field" type="file" class="file-upload-field" value="">
    <small>Error message</small>
  </div>

  <button type="submit"><?php echo $trad["AdminProjectForm"][$button]; ?></button>
  <div class="form-group">
    <a href="/admin/index.php" class="btn btn-dark btn-lg"><span class="mdi mdi-arrow-left"></span> <?= $trad["AdminProjectForm"]["go-back-btn"] ?></a>
  </div>
</form>