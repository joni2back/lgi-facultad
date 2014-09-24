<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li class="active">Administrador</li>
        </ul>

        <h2>Bienvenido: <?php echo $app->io->getSession('username'); ?></h1>
        <a href="index.php?page=login&action=logout">Cerrar sesion</a>

        <hr />

        <h3>Acciones: </h3>

        <h4>Articulos: </h4>
        <ul class="">
            <li><a href="index.php?page=admin-create-article" class="">Crear articulo</a></li>
            <li><a href="index.php?page=admin-select-article" class="">Eliminar articulo</a></li>
            <li><a href="index.php?page=admin-select-article" class="">Editar articulo</a></li>
        </ul>

        <h4>Consultas: </h4>
        <ul class="">
            <li><a href="index.php?page=admin-view-contacts" class="">Ver consultas</a></li>
        </ul>

        <h4>Fondos: </h4>
        <ul class="">
            <li><a href="index.php?page=admin-create-bank" class="">Alta bancos</a></li>
            <li><a href="index.php?page=admin-create-cheque-tipo" class="">Alta tipo de cheques</a></li>
            <li><a href="index.php?page=admin-create-forma-pago" class="">Alta tipo de formas de pago</a></li>
            <li><a href="index.php?page=admin-create-concepto" class="">Alta conceptos</a></li>
            <li><a href="index.php?page=admin-create-cheque" class="">Alta cheques</a></li>
            <li><a href="index.php?page=admin-view-movimiento-diario" class="">Consultar movimientos</a></li>
            <li><a href="index.php?page=admin-create-movimiento-diario" class="">Registrar movimiento</a></li>
        </ul>

    </div>
</div>