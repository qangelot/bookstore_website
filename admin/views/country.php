<?php $title = isset($country) ? $country['name'] : "Ajouter un pays"; ?>
<?php ob_start(); ?>

<div class="container">
  <form method="post">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name">Pays</label>
          <input
            required
            name="name"
            value="<?php echo isset($country) ? $country['name'] : ''; ?>"
            type="text" class="form-control"
            id="name"
            placeholder="Nom du pays">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="id" value="<?php echo isset($country['id']) ? $country['id'] : ''; ?>">
        <button name="country" type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
