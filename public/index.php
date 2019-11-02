<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title><?php echo $title ?> - E-bibliothèque</title>
    <link rel="icon" href="public/images/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/app.css">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="./">E-bibliothèque</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form id="search" class="form-inline my-2 my-lg-0 ml-auto" method="get" action="?action=books">
          <input value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>" class="form-control mr-sm-2" type="search" placeholder="Rechercher un livre" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher un livre</button>
        </form>
      </div>
    </nav>
    <?php if (isset($breadcrumb)) { ?>
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php foreach ($breadcrumb as $value) { ?>
              <?php if (isset($value['active']) && $value['active']) { ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $value['name']; ?></li>
              <?php } else { ?>
                <li class="breadcrumb-item"><a href="<?php echo $value['link']; ?>"><?php echo $value['name']; ?></a></li>
              <?php } ?>
            <?php } ?>
          </ol>
        </nav>
      </div>
    <?php } ?>
    <?php echo $content ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/app.js"></script>
  </body>
</html>
