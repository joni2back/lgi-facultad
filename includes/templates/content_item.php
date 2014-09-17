<?php

$articleId = $app->io->getRequest('id');
$article = $app->getArticleById($articleId);

?>

<div class="container">
    <div class="well">
        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li class="active">Articulos</li>
        </ul>

        <?php if (! $article) { ?>
            <div class="row-fluid">
                <div class="span12">
                    <h2>El articulo no existe</h2>
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
                        <a class="btn btn-large btn-success" href="index.php?page=purchase&articulo=<?php echo $article->id_article; ?>">Comprar</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt50">
            <h3>Articulos relacionados</h3>
            <div class="row-fluid">
                <?php foreach ($app->getArticlesByCategory($article->id_article_category, 4, $article->id_article) as $relatedArticle) { ?>
                    <div class="span3 text-center">
                        <a href="index.php?page=item&id=<?php echo $relatedArticle->id; ?>">
                            <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                            <?php echo $relatedArticle->title; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

    <?php } ?>

    </div>
</div>
