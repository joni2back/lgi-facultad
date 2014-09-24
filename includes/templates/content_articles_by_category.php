<?php

$categoryId = $app->io->getQuery('id');
$category = $app->getArticleCategory($categoryId);
$articles = $app->getArticlesByCategory($categoryId, 100);


?>
<div class="container ">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li class="active">Articulos <span class="divider">/</span></li>
            <li class="active">Articulos por categoria</li>
        </ul>
        <?php if (! $category) { ?>
            <h2>La categoria no existe</h2>
        <?php } else { ?>
            <h1><?php echo $category->name; ?></h1>
            <p>Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an.</p>

            <!-- ---------------------------------------------------------------------->
            <hr />
            <div class="well">

                  <div class="row-fluid" >
                    <?php foreach($articles as $article) { ?>
                        <div class="span3 articulo">
                            <div><small><?php echo $article->article_type; ?></small></div>
                            <div><img class="img-polaroid" src="<?php echo $app->getImageByCategory($categoryId); ?>" /></div>
                            <h4><?php echo $article->title; ?></h4>
                            <p><?php echo substr($article->description, 0, 100); ?> ...</p>
                            <p>
                                <a class="btn btn-mini btn-primary" href="index.php?page=item&id=<?php echo $article->id_article; ?>">Detalle</a>
                                <a class="btn btn-mini btn-inverse" href="index.php?page=purchase&id=<?php echo $article->id_article; ?>">Consultar</a>
                            </p>
                        </div>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
	</div><!-- /.row -->
</div><!-- /.container -->

