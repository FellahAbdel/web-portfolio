<form role="form" action="/admin/assets/actions/delete.php" method="post">
  <input type="hidden" name="project-id" value="<?php echo $projectId ?>">
  <p class="alert alert-warning"><?= $trad["AdminProjectForm"]["question"] ?></p>
  <div>
    <button type="submit" class="btn btn-warning"><?= $trad["AdminProjectForm"]["y-response"] ?></button>
    <a href="/admin/index.php" class="btn btn-dark btn-lg"><?= $trad["AdminProjectForm"]["n-response"] ?></a>
  </div>
</form>