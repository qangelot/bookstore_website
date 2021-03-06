<?php $title = "Liste des langues"; ?>
<?php ob_start(); ?>

<div class="container">
  <div class="row">
    <?php foreach ($languages as $key => $value) { ?>
      <div class="col-md-4 d-flex">
        <div class="action mr-1">
          <a href="?path=languages&action=unactive&id=<?php echo $value['id']; ?>&active=<?php echo !$value['active']; ?>">
            <i class="material-icons" style="color: <?php echo $value['active'] ? 'green' : 'gray'; ?>">done_outline</i>
          </a>
          <a href="?path=languages&action=edit&id=<?php echo $value['id']; ?>">
            <i class="material-icons">edit</i>
          </a>
        </div>
        <?php echo $value['name']; ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
