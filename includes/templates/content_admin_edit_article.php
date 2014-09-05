<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$action = $app->io->getPost('action');
$articleId = $app->io->getQuery('id');
$article = $app->getArticleById($articleId);


//$title = $app->io->getPost('title');
//$description = $app->io->getPost('description');
//$id_article_category = $app->io->getPost('id_article_category');
//$id_article_type = $app->io->getPost('id_article_type');
//$location = $app->io->getPost('location');
//$address = $app->io->getPost('address');
//$price = $app->io->getPost('price');

$successId = false;
$deletedOk = false;
if ($article) {
    $title = $article->title;
    $description = $article->description;
    $id_article_category = $article->id_article_category;
    $id_article_type = $article->id_article_type;
    $location = $article->location;
    $address = $article->address;
    $price = $article->price;

    if ($action === 'edit' && $app->io->getPost('title')) {
        $successId = $app->editArticle($articleId, $app->io->getPost());
    } elseif ($action === 'delete') {
        $deletedOk = $app->deleteArticle($articleId);
    }
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin-select-article">Seleccionar articulo</a> <span class="divider">/</span></li>
            <li class="active">Editar articulo</li>
        </ul>

        <div class="row-fluid">

          <div class="span12">
                <?php if (! $article) { ?>
                    <h2>El articulo no existe</h2>
                <?php } else { ?>
                    <?php if ($successId) { ?>
                        <h2>Se edito correctamente el articulo!</h2>
                        <h3>Acciones: </h3>
                        <ul class="">
                            <li><a href="index.php?page=item&id=<?php echo $successId; ?>">Ir al articulo</a></li>
                            <li><a href="index.php?page=admin-edit-article&id=<?php echo $articleId; ?>">Editarlo</a></li>
                            <li><a href="index.php?page=admin-create-article" class="">Crear otro articulo</a></li>
                        </ul>
                    <?php } elseif ($deletedOk) { ?>
                        <h2>Se elimino correctamente el articulo!</h2>
                        <h3>Acciones: </h3>
                        <ul class="">
                            <li><a href="index.php?page=admin-create-article" class="">Crear otro articulo</a></li>
                        </ul>
                    <?php } else { ?>
                        <form method="post" id="article-form" class="mb0">
                            <?php include_once 'article_form.php'; ?>
                            <hr />
                            <button type="submit" value="edit" name="action" class="btn btn-primary span2 pull-right">Editar</button>
                            <button type="submit" value="delete" name="action" class="btn btn-danger span2 pull-right">Eliminar</button>
                        </form>
                    <?php } ?>
                <?php } ?>
          </div>
        </div>

    </div>
</div>

