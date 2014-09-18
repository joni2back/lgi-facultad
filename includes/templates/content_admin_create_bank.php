<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$nombre = $app->io->getPost('nombre');
$sucursal = $app->io->getPost('sucursal');
$direccion = $app->io->getPost('direccion');

$successId = false;
if ($nombre) {
    $successId = $app->addBank($app->io->getPost());
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Crear banco</li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <?php if ($successId && $app->io->getPost()) { ?>
                    <h2>Se creo correctamente el banco!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=admin">Ir a la administracion</a></li>
                    </ul>
                <?php } elseif (!$successId && $app->io->getPost()) { ?>
                    <div class="alert alert-error">No se pudo guardar el banco.</div>
                <?php } else { ?>
                    <form method="post" id="bank-form" class="mb0">
                        <?php include_once 'bank_form.php'; ?>
                        <hr />
                        <button type="submit" class="btn btn-primary span2 pull-right">Confirmar</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

