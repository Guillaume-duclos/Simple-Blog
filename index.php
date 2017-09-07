<!DOCTYPE html>
<html lang="fr">
  <head>
  <!-- LINK -->
  <link rel="stylesheet" href="style.css" />
  <!-- META -->
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <!-- SCRIPT -->
  <script type="text/javascript" src="script.js"></script>
  <title>Blog</title>
</head>
  <body>

    <?php require('header.php'); ?>

    <div class="block-article columns block-page">
      <?php require('article.php'); ?>
    </div>

    <?php require('footer.php'); ?>

  </body>
</html>
