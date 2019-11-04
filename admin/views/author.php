<?php $title = isset($author) ? $author['name'] : "Ajouter un auteur"; ?>
<?php ob_start(); ?>

<div class="container">
  <form method="post">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name">Auteur</label>
          <input
            required
            name="name"
            value="<?php echo isset($author) ? $author['name'] : ''; ?>"
            type="text" class="form-control"
            id="name"
            placeholder="Nom de l'auteur">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="id" value="<?php echo isset($author['id']) ? $author['id'] : ''; ?>">
        <button name="author" type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
