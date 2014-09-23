<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$id_user = $app->io->getPost('id_user');
$id_concepto = $app->io->getPost('id_concepto');
$id_forma_pago = $app->io->getPost('id_forma_pago');
$fecha = $app->io->getPost('fecha');
$debe = $app->io->getPost('debe');
$haber = $app->io->getPost('haber');

$successId = false;
if ($id_user && $id_concepto && $id_forma_pago) {
    $successId = $app->addMovimientoDiario($app->io->getPost());
}

$suma_debe = $suma_haber = 0;

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Crear movimientos diarios</li>
        </ul>


        <?php foreach($app->getMovimientos() as $movimiento) { ?>
            <?php $suma_debe += $movimiento->debe; ?>
            <?php $suma_haber += $movimiento->haber; ?>
            <hr><?php print_r($movimiento); ?><hr>
            <b>Debe: <?php echo $suma_debe; ?></b>
            <b>Haber: <?php echo $suma_haber; ?></b>
        <?php } ?>

            <h3>Total Debe: <?php echo $suma_debe; ?></h3>
            <h3>Total Haber: <?php echo $suma_haber; ?></h3>
            <h3>Total: <?php echo ($suma_haber - $suma_debe); ?></h3>

        <div class="row-fluid">
            <div class="span12">
                <?php if ($successId && $app->io->getPost()) { ?>
                    <h2>Se creo correctamente el movimiento!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=item&id=<?php echo $successId; ?>">Ir al articulo</a></li>
                        <li><a href="index.php?page=admin-edit-article&id=<?php echo $successId; ?>">Editarlo</a></li>
                        <li><a href="index.php?page=admin-edit-article&id=<?php echo $successId; ?>">Eliminarlo</a></li>
                        <li><a href="index.php?page=admin-create-article" class="">Crear otro articulo</a></li>
                    </ul>
                <?php } elseif (!$successId && $app->io->getPost()) { ?>
                    <div class="alert alert-error">No se pudo guardar el movimiento.</div>
                <?php } else { ?>
                    <form method="post" id="article-form" class="mb0">
                        <?php include_once 'movimiento_diario_form.php'; ?>
                        <hr />
                        <button type="submit" class="btn btn-primary span2 pull-right">Confirmar</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

