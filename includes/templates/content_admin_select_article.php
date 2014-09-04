<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$articles = $app->getArticles();

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Editar articulo</li>
        </ul>

        <div class="row-fluid">

            <div class="span12">
                <form method="get" id="article-select-form" class="mb0" action="index.php">
                    <h2>Seleccione el articulo</h2>

                    <input type="hidden" name="page" value="admin-edit-article" />
                    <select name="id" class="span12">
                        <?php foreach($app->getArticles() as $article) { ?>
                            <option <?php echo $article->id == null ? 'selected="selected"':''; ?> value="<?php echo $article->id; ?>"><?php echo $article->title; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary span2 pull-right">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

