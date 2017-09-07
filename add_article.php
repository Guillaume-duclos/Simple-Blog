<!-- ============================================================================================= -->
<!--                                         AJOUT D'UN ARTICLE                                    -->
<!-- ============================================================================================= -->

<?php

  $feed_back = null;

  require('bdd.php');

  if(isset($_POST['title'], $_POST['sub_title'], $_POST['autor'], $_POST['content'], $_POST['category'])) {
    if(!empty($_POST['title'] AND $_POST['sub_title'] AND $_POST['autor'] AND $_POST['content'] AND $_POST['category']) AND $_POST['category'] !== 'null') {

        //Initialisation des variables POST

        $title         = htmlspecialchars($_POST['title']);
        $sub_title     = htmlspecialchars($_POST['sub_title']);
        $autor         = htmlspecialchars($_POST['autor']);
        $content       = htmlspecialchars($_POST['content']);
        $category      = htmlspecialchars($_POST['category']);

        //Initialisation des variables FILES

        $file_name     = $_FILES['illustration']['name'];
        $file_size     = $_FILES['illustration']['size'];
        $file_location = $_FILES['illustration']['tmp_name'];

        $max_file_size = 2048000;
        $valid_extensions = array('jpg', 'jpeg', 'png', 'gif');

        //Upload de l'image

        if($file_size < $max_file_size) {
          $upload_extension = strtolower(substr(strrchr($file_name, '.'), 1)); //strrchr renvoie l'extension du fichier avec le point, substr ignore le premier caractère, ici le point, et le strtolower pour tout mettre en minuscule
          if(in_array($upload_extension, $valid_extensions)) {
            $directory = "article_img/".$file_name;
            $upload = move_uploaded_file($file_location, $directory);
            if($upload) {
              $insert = $bdd->prepare('INSERT INTO article (title, sub_title, autor, date_time_publication, content, illustration, category) VALUES (?, ?, ?, NOW(), ?, ?, ?)');
              $insert->execute(array($title, $sub_title, $autor, $content, $file_name, $category));
              $feed_back = "Article publié";
            } else {
              $feed_back = "Un problème est survenue lors de l'envoie de l'image.";
            }
          } else {
            $feed_back = "Une image doit être ajouté au format, jpg, jpeg, png ou gig.";
          }
        } else {
          $feed_back = "L'image doit être inférieur à 2Mo.";
        }
     } else {
       $feed_back = "Veuillez remplir tous les champs.";
     }
  }

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <!-- LINK -->
  <link rel="stylesheet" href="style.css" />
  <!-- META -->
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <!-- SCRIPT -->
  <script type="text/javascript" src="js/script.js"></script>
  <title>Blog</title>
</head>
  <body>

    <?php require('header.php'); ?>

    <form action="add_article.php" method="post" enctype="multipart/form-data" class="anim">
      <input type="text" name="title" placeholder="Le titre de l'article"/>
      <input type="text" name="sub_title" placeholder="Le sous-titre de l'article"/>
      <input type="text" name="autor" placeholder="L'auteur"/>
      <textarea type="text" name="content" placeholder="Le contenu..."></textarea>
      <input type="file" name="illustration"/>
      <select name="category">
        <option value="null">Catégorie</option>
        <option value="code">Code</option>
        <option value="design">Web Design</option>
        <option value="ux">UX</option>
        <option value="marketing">Web Marketing</option>
      </select>
      <input class="submit" type="submit" value="Enregistrer"/>
      <?php
        if(isset($feed_back)) {
          ?> <p class="feed_back"><?php echo $feed_back; ?></p><?php
        }
      ?>
    </form>

    <?php require('footer.php'); ?>

  </body>
</html>
