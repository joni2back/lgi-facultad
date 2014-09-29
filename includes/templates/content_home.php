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
</div>

