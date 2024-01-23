<li>
  <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>" />
  <article>
    <div>
      <h2><?= $project["title"] ?> </h2>
      <p>
        <?= htmlspecialchars_decode(substr($project["description"], 0, 400)) ?>...
      </p>
    </div>
    <footer>
      <a href="/projectItem.php?id=<?= $project["id"] ?>"><?= $trad["projectSection"]["viewButton"]  ?> <i class="mdi mdi-arrow-right-thick"></i></a>
    </footer>
  </article>
</li>