<form role="form" action="/admin/assets/actions/<?php echo $fileHandler; ?>" method="post" enctype="multipart/form-data">
  <div class="form-control">
    <label for="project-title"><?= $trad["AdminProjectForm"]["project title"] ?></label>
    <input type="text" name="project-title" id="project-title" placeholder="<?= $trad["AdminProjectForm"]["project title"] ?>" value="<?php echo $title ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="description"><?= $trad["AdminProjectForm"]["description"] ?></label>
    <textarea name="description" id="description" cols="30" rows="9" placeholder="<?= $trad["AdminProjectForm"]["description"] ?>"> <?php echo $description ?> </textarea>
    <small>Error message</small>
  </div>
  <div class="form-control">
    <label for="text-alt"><?= $trad["AdminProjectForm"]["text alt"] ?></label>
    <input type="text" name="text-alt" id="text-alt" placeholder="<?= $trad["AdminProjectForm"]["text alt"] ?>" value="<?php echo $textAlt ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>
  <img width="100px" src="/public/uploads/<?php echo $imageName ?>" alt="">
  <div class="file-upload-wrapper" data-text="<?= $trad["AdminProjectForm"]["project image"] ?>">
    <input name="file-upload-field" type="file" class="file-upload-field" value="">
    <small>Error message</small>
  </div>
  <button type="submit"><?php echo $trad["AdminProjectForm"][$button]; ?></button>
</form>