<li>
  <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" />
  <article>
    <div>
      <h2><?= $project["title"] ?> </h2>
      <p>
        <?= substr($project["description"], 0, 300) ?>
      </p>
    </div>
    <footer>
      <a href="/projectItem.php?id=<?= $project["id"] ?>"><?= $trad["projectSection"]["exploreButton"]  ?> <i class="mdi mdi-arrow-right-thick"></i></a>
    </footer>
  </article>
</li>