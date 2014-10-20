<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$title = $app->io->getPost('title');
$description = $app->io->getPost('description');
$id_article_category = $app->io->getPost('id_article_category');
$id_article_type = $app->io->getPost('id_article_type');
$location = $app->io->getPost('location');
$address = $app->io->getPost('address');
$price = $app->io->getPost('price');
$oferta = $app->io->getPost('oferta');

$successId = false;
if ($app->io->getPost('title')) {
    $successId = $app->addArticle($app->io->getPost(), $app->io->getSession('user')->id_user);
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Crear articulo</li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <?php if ($successId && $app->io->getPost()) { ?>
                    <h2>Se creo correctamente el articulo!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=item&id=<?php echo $successId; ?>">Ir al articulo</a></li>
                        <li><a href="index.php?page=admin-edit-article&id=<?php echo $successId; ?>">Editarlo</a></li>
                        <li><a href="index.php?page=admin-edit-article&id=<?php echo $successId; ?>">Eliminarlo</a></li>
                        <li><a href="index.php?page=admin-create-article" class="">Crear otro articulo</a></li>
                    </ul>
                <?php } elseif (!$successId && $app->io->getPost()) { ?>
                    <div class="alert alert-error">No se pudo guardar el articulo.</div>
                <?php } else { ?>
                    <form method="post" id="article-form" class="mb0">
                        <?php include_once 'article_form.php'; ?>
                        <hr />
                        <button type="submit" class="btn btn-primary span2 pull-right">Confirmar</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

