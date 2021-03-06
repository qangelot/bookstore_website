<?php $title = isset($language) ? $language['name'] : "Ajouter une langue"; ?>
<?php ob_start(); ?>

<div class="container">
  <form method="post">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name">Langue</label>
          <input
            required
            name="name"
            value="<?php echo isset($language) ? $language['name'] : ''; ?>"
            type="text" class="form-control"
            id="name"
            placeholder="Nom de la langue">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="id" value="<?php echo isset($language['id']) ? $language['id'] : ''; ?>">
        <button name="language" type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
