<?php

$errorMsg = '';
$articleId = $app->io->getRequest('id');
$article = $app->getArticleById($articleId);


if (! $article) {
    $errorMsg = 'No se ha encontrado el articulo';
}
?>


<div class="container">
    <div class="well well-small">
    <?php if (! $article) { ?>
        <div class="row mt10">
            <div class="span12">
                <h1 class=""><?php echo $errorMsg; ?></h1>
            </div>
        </div>

    <?php } else { ?>



    <div class="row-fluid">
        <div class="span12">
            <h1 class="page-header">
                <?php echo $article->title; ?>
                <small> - <?php echo $article->article_category; ?></small>
            </h1>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span8">
            <img class="img-responsive" src="http://placehold.it/750x500" alt="">
        </div>
        <div class="span4">

            <h3>Descripcion</h3>
            <p><?php echo $article->description; ?></p>

            <h3>Detalles</h3>
            <ul>
                <li>Categoria: <b><?php echo $article->article_category; ?></b></li>
                <li>Tipo: <b><?php echo $article->article_type; ?></b></li>
                <li>Localidad: <b><?php echo $article->location; ?></b></li>
                <li>Direccion: <b><?php echo $article->address; ?></b></li>
            </ul>
            <hr />
            <ul class="unstyled">
                <li><h2><?php echo '$' . $article->price; ?></h2></li>
                <li>
                    <a class="btn btn-large btn-success" href="contact-purchase.php?articulo=<?php echo $article->id; ?>">Comprar</a>
                </li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="span12">
            <h3 class="page-header">Articulos relacionados</h3>
        </div>

        <?php foreach ($app->getArticlesByCategory($article->id_article_category) as $relatedArticle) { ?>
            <div class="span3">
                <a href="item.php?id=<?php echo $relatedArticle->id; ?>" class="text-center">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                    <?php echo $relatedArticle->title; ?>
                </a>
            </div>
        <?php } ?>

    </div>

    <?php } ?>

</div>
</div>
