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
        <ul class="">
            <li><a href="index.php?page=admin-create-article" class="">Crear articulo</button>
            <li><a href="index.php?page=admin-create-article" class="">Eliminar articulo</button>
            <li><a href="index.php?page=admin-create-article" class="">Editar articulo</button>
        </ul>

    </div>
</div>