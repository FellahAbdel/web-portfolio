<li>
  <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" />
  <article>
    <div>
      <h2><?= $project["title"] ?> </h2>
      <p>
        <?= htmlspecialchars_decode(substr($project["description"], 0, 300)) ?>
      </p>
    </div>
    <footer>
      <a href="/admin/update.php?id=<?= $project["id"] ?>" class="btn btn-primary btn-lg"> <span class="mdi mdi-pencil"></span><?= $trad["adminActions"]["edit"] ?></a>
      <a href="/admin/delete.php?id=<?= $project["id"] ?>" class="btn btn-lg btn-danger"> <span class="mdi mdi-delete"></span> <?= $trad["adminActions"]["delete"] ?></a>
      <a href="/projectItem.php?id=<?= $project["id"] ?>" class="btn btn-dark btn-lg"> <span class="mdi mdi-arrow-right-thick"></span> <?= $trad["projectSection"]["viewButton"] ?></a>
    </footer>
  </article>
</li>