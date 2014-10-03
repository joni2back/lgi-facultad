<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$action = $app->io->getPost('action');
$userId = $app->io->getQuery('id');
$user = $app->getUserById($userId);

$success = false;
$deletedOk = false;
if ($user) {
    $id_role = $user->id_role;
    $username = $user->username;
    $password = $user->password;
    $first_name = $user->first_name;
    $last_name = $user->last_name;

    if ($action === 'edit' && $username && $password) {
        $success = $app->editUser($userId, $app->io->getPost());
    } elseif ($action === 'delete') {
        $deletedOk = $app->deleteUser($userId);
    }
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin-select-user">Seleccionar usuario</a> <span class="divider">/</span></li>
            <li class="active">Editar usuario</li>
        </ul>

        <div class="row-fluid">

          <div class="span12">
                <?php if (! $user) { ?>
                    <h2>El usuario no existe</h2>
                <?php } else { ?>
                    <?php if ($success) { ?>
                        <h2>Se edito correctamente el usuario!</h2>
                        <h3>Acciones: </h3>
                        <ul class="">
                        <li><a href="index.php?page=admin">Ir a la administracion</a></li>
                            <li><a href="index.php?page=admin-edit-user&id=<?php echo $userId; ?>">Editarlo</a></li>
                            <li><a href="index.php?page=admin-create-user" class="">Crear otro usuario</a></li>
                        </ul>
                    <?php } elseif ($deletedOk) { ?>
                        <h2>Se elimino correctamente el usuario!</h2>
                        <h3>Acciones: </h3>
                        <ul class="">
                            <li><a href="index.php?page=admin-create-user" class="">Crear otro usuario</a></li>
                        </ul>
                    <?php } else { ?>
                        <form method="post" id="article-form" class="mb0">
                            <?php include_once 'user_form.php'; ?>
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

