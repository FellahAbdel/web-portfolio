<li>
  <img src="/assets/images/projects/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" />
  <article>
    <div>
      <h2><?= $project["title"] ?> </h2>
      <p>
        <?= substr($project["description"], 0, 300) ?>
      </p>
    </div>
    <footer>
      <a href="/edit.php?id=<?= $project["id"] ?>" class="btn btn-primary btn-lg"> <span class="mdi mdi-pencil"></span><?= $trad["adminActions"]["edit"] ?></a>
      <a href="/delete.php?id=<?= $project["id"] ?>" class="btn btn-lg btn-danger"> <span class="mdi mdi-delete"></span> <?= $trad["adminActions"]["delete"] ?></a>
      <a href="/projectItem.php?id=<?= $project["id"] ?>" class="btn btn-dark btn-lg"> <span class="mdi mdi-arrow-right-thick"></span> <?= $trad["projectSection"]["exploreButton"] ?></a>
    </footer>
  </article>
</li>