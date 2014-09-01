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
            <h2 class="mb25">Ingreso al sitio</h1>
            <form class="mb0" method="post" action="login.php?action=login">

                <div>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input name="username" type="text" placeholder="Nombre de usuario" class="span5"/>
                    </div>
                </div>

                <div>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input name="password" type="password" placeholder="Contraseña" class="span5"/>
                    </div>
                </div>

                <?php if ($errorMsg) { ?>
                    <div>
                        <div class="alert alert-error"><?php echo $errorMsg; ?></div>
                    </div>
                <?php } ?>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-circle-arrow-right white"></i> Iniciar sesion
                    </button>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

