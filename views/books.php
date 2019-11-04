<?php $title = "Liste des livres"; ?>
<?php ob_start(); ?>
<style>
  .book .image {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .book .image a,
  .book .image img {
    height: 100%;
    width: 100%;
  }

  .book .title > a {
    color: inherit;
  }


  @media (min-width: 768px) {
    .book .image {
      height: 300px;
    }
  }

  @media (min-width: 1200px) {
    .book .image {
      height: 360px;
    }
  }
</style>
<?php include('utils/uri.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-8">
      <h1>Liste des livres</h1>
    </div>
    <?php if (count($books) > 1) { ?>
      <div class="col-md-12 col-lg-4 ml-auto">
        <form method="get" action="<?php echo getQueries($_SERVER['QUERY_STRING'], array(), array('page', 'sort')); ?>">
          <div class="form-group">
            <select class="form-control" id="sortBooks">
              <?php foreach ($sortValues as $value) { ?>
                <option <?php echo $value['value'] === $sort ? 'selected' : ''; ?>
                  value="<?php echo $value['value']; ?>"><?php echo $value['name']; ?></option>
              <?php } ?>
            </select>
          </div>
        </form>
      </div>
    <?php } ?>
  </div>
  <div class="row">
    <?php if (empty($books)) { ?>
      <div class="col-md-12 mt-3">
        <div class="alert alert-warning" role="alert">
          Désolé, aucun livre correspond à votre recherche.
        </div>
      </div>
    <?php } else { ?>
      <?php foreach ($books as $book) {
        $link = './?id=' . $book['id']; ?>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="card book h-100">
            <div class="image">
              <a href="<?php echo $link; ?>">
                <img
                  src="<?php echo $book['image']; ?>"
                  class="card-img-top"
                  alt="Image du livre <?php echo $book['title']; ?>">
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title title"><a href="<?php echo $link; ?>"><?php echo $book['title']; ?></a></h5>
              <p class="card-text text-muted">
                <?php if ($book['author']) {
                  echo $book['author'] . ' (Auteur)<br>';
                } ?>
                Paru en <?php echo $book['year']; ?>
                <br>
                <?php echo $book['language'] . ' (Langue)'; ?>
              </p>
            </div>
            <div class="card-footer text-center">
              <a href="<?php echo $link; ?>" class="btn btn-primary">En savoir plus</a>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
  <?php if ($pages > 1) { ?>
    <div class="row mt-3">
      <div class="col-md-12">
        <nav aria-label="Page navigation livres">
          <ul class="pagination justify-content-center">
            <?php if ($page === 1) { ?>
              <li class="page-item disabled">
                <span class="page-link">Précédent</span>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a class="page-link" href="<?php echo getQueries($_SERVER['QUERY_STRING'], array('page' => $page - 1)); ?>">Précédent</a>
              </li>
            <?php } ?>
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
              <?php if ($i === $page) { ?>
                <li class="page-item active" aria-current="page">
                  <span class="page-link">
                    <?php echo $i; ?> <span class="sr-only">(current)</span>
                  </span>
                </li>
              <?php } else { ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo getQueries($_SERVER['QUERY_STRING'], array('page' => $i)); ?>"><?php echo $i; ?></a>
                </li>
              <?php } ?>
            <?php } ?>
            <?php if ($page === $pages) { ?>
              <li class="page-item disabled">
                <span class="page-link">Suivant</span>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a class="page-link" href="<?php echo getQueries($_SERVER['QUERY_STRING'], array('page' => $page + 1)); ?>">Suivant</a>
              </li>
            <?php } ?>
          </ul>
        </nav>
      <div>
    <?php } ?>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
