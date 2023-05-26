<tr>
  <td><?= $project["title"] ?></td>
  <td><?= substr($project["description"], 0, 100) ?></td>
  <td width="300px">
    <a href="view.php?id=<?= $project["id"] ?>" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span>Voir</a>
    <a href="update.php?id=<?= $project["id"] ?>" class="btn btn-primary"> <span class="glyphicon glyphicon-pencil"></span>Modifier</a>
    <a href="delete.php?id=<?= $project["id"] ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span>Supprimer</a>
  </td>
</tr>