<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$id_tipo_cheque = $app->io->getPost('id_tipo_cheque');
$id_banco = $app->io->getPost('id_banco');
$numero = $app->io->getPost('numero');
$fecha = $app->io->getPost('fecha');

$successId = false;
if ($id_tipo_cheque && $id_banco && $numero) {
    $successId = $app->addCheque($app->io->getPost());
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Alta de cheques</li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <?php if ($successId && $app->io->getPost()) { ?>
                    <h2>Se dio de alta correctamente el cheque!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=admin">Ir a la administracion</a></li>
                    </ul>
                <?php } elseif (!$successId && $app->io->getPost()) { ?>
                    <div class="alert alert-error">No se pudo guardar el cheque.</div>
                <?php } else { ?>
                    <form method="post" id="article-form" class="mb0">
                        <?php include_once 'cheque_form.php'; ?>
                        <hr />
                        <button type="submit" class="btn btn-primary span2 pull-right">Confirmar</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

