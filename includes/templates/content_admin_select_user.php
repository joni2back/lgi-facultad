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
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Seleccionar articulo</li>
        </ul>

        <div class="row-fluid">

            <div class="span12">
                <form method="get" id="article-select-form" class="mb0" action="index.php">
                    <h2>Seleccione el articulo</h2>

                    <input type="hidden" name="page" value="admin-edit-user" />
                    <select name="id" class="span12">
                        <?php foreach($app->getUsers() as $user) { ?>
                            <option <?php echo $user->id_user == null ? 'selected="selected"':''; ?> value="<?php echo $user->id_user; ?>"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?> (<?php echo $user->username; ?>)</option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary span1 pull-right">Ir</button>
                </form>
            </div>
        </div>
    </div>
</div>

