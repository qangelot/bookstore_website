<?php $title = "Liste des livres"; ?>
<?php ob_start(); ?>
<?php $author = $book['author'] !== 'Unknown' ? $book['author'] : 'Inconnu'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-4 mt-3">
      <img
        src="<?php echo $book['imageLink']; ?>"
        class="card-img-top"
        alt="Image du livre <?php echo $book['title']; ?>"
        style="max-height: 500px;">
    </div>
    <div class="col-md-8 mt-3">
      <h1><?php echo $book['title']; ?></h1>
      <div class="info">
        <?php echo $author; ?> (Auteur) - Paru en <?php echo $book['year']; ?>
      </div>
      <table class="table table-striped mt-4">
        <tbody>
          <tr>
            <td>Auteur</td>
            <th><?php echo $author; ?></th>
          </tr>
          <tr>
            <td>Date de parution</td>
            <th><?php echo $book['year']; ?></th>
          </tr>
          <tr>
            <td>Origine</td>
            <th><?php echo $book['country']; ?></th>
          </tr>
          <tr>
            <td>Langue</td>
            <th><?php echo $book['language']; ?></th>
          </tr>
          <tr>
            <td>Pages</td>
            <th><?php echo $book['pages']; ?></th>
          </tr>
          <tr>
            <td>Wikipedia</td>
            <th><a href="<?php echo $book['link']; ?>">Voir</a></th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
