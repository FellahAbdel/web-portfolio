<li>
  <img src="/assets/images/projects/<?= $project["imageName"] ?>" alt="" />
  <article>
    <div>
      <h2><?= $project["title"] ?> </h2>
      <p>
        <?= substr($project["description"], 0, 300) ?>
      </p>
    </div>
    <footer>
      <a href="/projectItem.php?id=<?= $project["id"] ?>">explore -></a>
    </footer>
  </article>
</li>