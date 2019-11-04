<?php http_response_code(404); ?>
<?php $title = 'Page not found'; ?>
<?php ob_start(); ?>
<div class="container mt-5 text-center">
  <h1>Page non trouvée</h1>
  <p>Cette page n'existe pas.</p>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('public/index.php'); ?>
