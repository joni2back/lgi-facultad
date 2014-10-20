<?php
$articlesOfertas = $app->getArticles(true);
?>

<div class="container marketing">
  <div class="row articulos-homepage">
    <?php foreach($app->getArticleCategories() as $category) { ?>
        <div class="span6">
            <a href="index.php?page=articles-by-category&id=<?php echo $category->id_article_category; ?>">
                <img class="img-polaroid" src="<?php echo $app->getImageByCategory($category->id_article_category); ?>">
                <h2><?php echo $category->name; ?></h2>
            </a>
        </div>
    <?php } ?>
  </div>

<hr />

<?php if ($articlesOfertas) { ?>
    <h3>Ofertas</h3>
    <div class="row-fluid" >
      <?php foreach($articlesOfertas as $article) { ?>
          <div class="span3 text-center">
              <div><img class="img-polaroid" src="<?php echo $app->getImageByCategory($article->id_article_category); ?>" /></div>
              <h4><?php echo $article->title; ?></h4>
              <p>
                  <a class="btn btn-mini btn-primary" href="index.php?page=item&id=<?php echo $article->id_article; ?>">Detalle</a>
              </p>
          </div>
      <?php } ?>
    </div>
<?php } ?>
</div>