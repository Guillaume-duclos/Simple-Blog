<!-- ============================================================================================= -->
<!--                                 LA LISTE DE TOUS LE ARTICLES                                  -->
<!-- ============================================================================================= -->

<?php

  require('bdd.php');

  setlocale(LC_TIME, 'fr');

  $requete_get_post_article = $bdd->query('SELECT * FROM article ORDER BY date_time_publication DESC');
  $requete_get_nb_article = $bdd->query('SELECT COUNT(*) FROM article');
  $nb_article = $requete_get_nb_article->fetchColumn();

  function min_texte($texte, $limite) {
    $tab = explode(' ', $texte, ($limite + 1));
    if(count($tab) > $limite) {
      array_pop($tab);
    }
    return implode(' ', $tab);
  }

  if($nb_article > 0) {
    while($data = $requete_get_post_article->fetch()) {
      $date_time_publication = $data['date_time_publication'];
      $date_article = ucfirst(strftime('%A %d %B %Y', strtotime($date_time_publication)));

      ?>

      <div class="article min_article">
        <h2><?php echo $data['title']; ?></h2>
        <h3><?php echo $data['sub_title']; ?></h3>
        <p class="article-infos">De <?php echo $data['autor']; ?></p>
        <p class="article-infos">Publier le <?php echo $date_article; ?></p>
        <img src='article_img/<?php echo $data['illustration']; ?>'/>
        <p class="paragraphe"><?php echo min_texte($data['content'], 60); ?></p>
        <p class="article-infos">Catégorie : <?php echo $data['category']; ?></p>
        <?php echo '<a href="view_article.php?id=' .$data['id']. '">Voir plus</a>'; ?>
      </div>
      <?php
    }
  } else {
    ?> <p class="no_content">Aucun article de disponible pour le moment...</p> <?php
  }

  $requete_get_post_article->closeCursor();
  $requete_get_nb_article->closeCursor();

?>
