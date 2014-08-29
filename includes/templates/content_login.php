<?php

$errorMsg = '';

if ($app->io->getRequest('action') === 'logout') {
    $app->logout();
}

if ($app->io->getRequest('action') === 'login') {
    $username = $app->io->getPost('username');
    $password = $app->io->getPost('password');

    if ($username || $password) {
        $user = $app->getUserByCredentials($username, $password);

        if (! $app->loginUser($user)) {
            $errorMsg = 'El usuario o contraseña son invalidos';
        }
    }
}
?>

<div class="container">
    <div class="well">
        <?php if ($app->io->getSession('username')) { ?>
            <h2>Bienvenido: <?php echo $app->io->getSession('username'); ?></h1>
            <a href="login.php?action=logout">Cerrar sesion</a>
        <?php } else { ?>
            <h2>Ingreso a la administracion</h1>
            <form method="post" action="login.php?action=login">
                <div>
                    <input name="username" type="text" placeholder="Nombre de usuario"/>
                </div>

                <div>
                    <input name="password" type="password" placeholder="Contraseña" />
                </div>

                <?php if ($errorMsg) { ?>
                    <div class="alert alert-error"><?php echo $errorMsg; ?></div>
                <?php } ?>

                <div>
                    <input type="submit" value="Iniciar sesion" class="btn btn-primary"/>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

