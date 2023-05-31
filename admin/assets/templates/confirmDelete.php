<form role="form" action="/admin/assets/actions/<?php echo $fileHandler; ?>" method="post">
  <p class="alert alert-warning"><?= $trad["AdminProjectForm"]["question"] ?></p>
  <div class="form-group">
    <button type="submit" class="btn btn-warning"><?php echo $trad["AdminProjectForm"][$button]; ?><?= $trad["AdminProjectForm"]["y-response"] ?></button>
    <a href="/admin/index.php" class="btn btn-dark btn-lg"><?= $trad["AdminProjectForm"]["n-response"] ?></a>
  </div>
</form>