<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#content',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>

<form role="form" action="/admin/assets/actions/<?php echo $fileHandler; ?>" method="post" enctype="multipart/form-data">
  <div class="form-control">
    <label for="article-title"><?= $trad["AdminArticleForm"]["title"] ?? "Titre de l'article" ?></label>
    <input type="text" name="article-title" id="article-title" placeholder="<?= $trad["AdminArticleForm"]["title"] ?? "Titre" ?>" value="<?php echo isset($title) ? $title : ''; ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="content"><?= $trad["AdminArticleForm"]["content"] ?? "Contenu" ?></label>
    <textarea name="content" id="content" cols="30" rows="20" placeholder="<?= $trad["AdminArticleForm"]["content"] ?? "Contenu" ?>"><?php echo isset($content) ? $content : ''; ?></textarea>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="text-alt"><?= $trad["AdminArticleForm"]["text alt"] ?? "Texte alternatif" ?></label>
    <input type="text" name="text-alt" id="text-alt" placeholder="<?= $trad["AdminArticleForm"]["text alt"] ?? "Texte alternatif" ?>" value="<?php echo isset($textAlt) ? $textAlt : ''; ?>" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <?php if (isset($imageName)) { ?>
    <img width="100px" src="/public/uploads/<?php echo $imageName; ?>" alt="">
  <?php } ?>

  <div class="file-upload-wrapper" data-text="<?= $trad["AdminArticleForm"]["image"] ?? "Image de l'article" ?>">
    <input name="file-upload-field" type="file" class="file-upload-field" value="">
    <small>Error message</small>
  </div>

  <button type="submit"><?php echo $trad["AdminArticleForm"][$button] ?? "Valider"; ?></button>
  <div class="form-group">
    <a href="/admin/articles.php" class="btn btn-dark btn-lg"><span class="mdi mdi-arrow-left"></span> <?= $trad["AdminArticleForm"]["go-back-btn"] ?? "Retour" ?></a>
  </div>
</form>
