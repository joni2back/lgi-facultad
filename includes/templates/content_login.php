<?php

$errorMsg = '';
if ($username || $password) {
    $user = $app->getUserByCredentials($username, $password);
    if (! $app->loginUser($user)) {
        $errorMsg = 'El usuario o contraseña son invalidos';
    }
}

?>


<div class="container ">
    <div class="well">

        <?php if ($app->getSessionVar('username')) { ?>
            <h2>Bienvenido <?php echo $app->getSessionVar('username'); ?></h1>
        <?php } else { ?>
            <h2>Ingreso a la administracion</h1>
            <form method="post">
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

