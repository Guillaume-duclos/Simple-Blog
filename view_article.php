<!-- ============================================================================================= -->
<!--                           LE CONTENU COMPLET DE L'ARTICLE CHOISI                              -->
<!-- ============================================================================================= -->

<?php
  require('bdd.php');
  setlocale(LC_TIME, 'fr');

  //========================== RECUPERATION DE L'ARTICLE ==========================

    if(isset($_GET['id']) AND !empty($_GET['id'])) {
      $get_id = htmlspecialchars($_GET['id']);

      $requete_get_article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
      $requete_get_article->execute(array($get_id));

      $requete_get_comment = $bdd->prepare('SELECT * FROM comment WHERE id_article = ? ORDER BY id DESC');
      $requete_get_comment->execute(array($get_id));

      $data = $requete_get_article->fetch();

      $date_time_publication = $data['date_time_publication'];
      $date_article = ucfirst(strftime('%A %d %B %Y', strtotime($date_time_publication)));
      
      //========================== TRAITEMENT DES COMMENTAIRES ==========================

      if(isset($_POST['submit_comment'])) {
        if(isset($_POST['name'], $_POST['comment']) AND !empty($_POST['name']) AND !empty($_POST['comment'])) {
          $name = htmlspecialchars($_POST['name']);
          $comment = htmlspecialchars($_POST['comment']);
          $requete_post_comment = $bdd->prepare('INSERT INTO comment (date_time_comment_publication, name, comment, id_article) VALUES (NOW(), ?, ?, ?)');
          $requete_post_comment->execute(array($name, $comment, $get_id));
          $feed_back = "Commentaire envoyé.";
        } else {
          $feed_back = "Veuillez remplir tous le champs.";
        }
      }
    } else {
      $feed_back = "L'article avec l'ID n'a pas été trouvé";
    } ?>

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

    <div class="article complet_article">
      <h2><?php echo $data['title']; ?></h2>
      <h3><?php echo $data['sub_title']; ?></h3>
      <p class="article-infos">De <?php echo $data['autor']; ?></p>
      <p class="article-infos">Publier le <?php echo $date_article; ?></p>
      <img src='article_img/<?php echo $data['illustration']; ?>'/>
      <p class="paragraphe"><?php echo $data['content']; ?></p>
      <p class="article-infos">Catégorie : <?php echo $data['category']; ?></p>
      <a href="index.php">Retourner à la liste des articles</a>
    </div>

    <?php
      while($data_comment = $requete_get_comment->fetch()) {
        $date_time_comment_publication = $data_comment['date_time_comment_publication'];
        $date_comment = ucfirst(strftime('%A %d %B %Y', strtotime($date_time_comment_publication)));
        ?>
        <div class="article comment">
          <p class="article-infos">Publier le <?php echo $date_comment; ?></p>
          <p>Publier par : <?php echo $data_comment['name']; ?></p>
          <p>Commentaire : <?php echo $data_comment['comment']; ?></p>
        </div>
      <?php } ?>

    <form action="view_article.php?id=<?php echo $get_id; ?>" method="post" class="form_comment">
      <label>Laissez un commentaire</label>
      <input type=text name="name" placeholder="Votre nom"/>
      <textarea name="comment" placeholder="Votre commentaire ici"></textarea>
      <input class="submit" type="submit" name="submit_comment" value="Envoyer"/>
      <?php
        if(isset($feed_back)) {
          ?> <p class="feed_back"><?php echo $feed_back; ?></p><?php
        }
      ?>
    </form>

    <?php require('footer.php'); ?>

  </body>
</html>
