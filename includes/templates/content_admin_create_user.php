<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$id_role = $app->io->getPost('id_role');
$username = $app->io->getPost('username');
$password = $app->io->getPost('password');
$first_name = $app->io->getPost('first_name');
$last_name = $app->io->getPost('last_name');

$successId = false;
if ($id_role && $username && $password) {
    $successId = $app->addUser($app->io->getPost());
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Crear usuario</li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <?php if ($successId && $app->io->getPost()) { ?>
                    <h2>Se creo correctamente el usuario!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=admin">Ir a la administracion</a></li>
                    </ul>
                <?php } elseif (!$successId && $app->io->getPost()) { ?>
                    <div class="alert alert-error">No se pudo guardar el usuario.</div>
                <?php } else { ?>
                    <form method="post" id="article-form" class="mb0">
                        <?php include_once 'user_form.php'; ?>
                        <hr />
                        <button type="submit" class="btn btn-primary span2 pull-right">Confirmar</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

