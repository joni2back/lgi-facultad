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
            <li class="active">Crear articulo</li>
        </ul>

        <div class="row-fluid">

          <div class="span12">

                <form method="post" action="">
                  <fieldset>
                    <legend>Nuevo articulo</legend>

                    <label>Titulo</label>
                    <input type="text" name="name" placeholder="Ingrese el titulo...">

                    <label>Descripcion</label>
                    <textarea rows="3" placeholder="Ingrese el contenido..."></textarea>

                    <label>Categoria</label>
                    <select name="article_category">
                        <?php foreach($app->getArticleCategories() as $category) { ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        <?php } ?>
                    </select>

                    <label>Tipo</label>
                    <select name="article_type">
                        <?php foreach($app->getArticleTypes() as $type) { ?>
                            <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                        <?php } ?>
                    </select>

                    <label>Localidad</label>
                    <input type="text" placeholder="Ingrese la localidad...">

                    <label>Telefono</label>
                    <input type="text" placeholder="Ingrese el telefono...">

                    <label>Precio</label>
                    <input type="text" placeholder="Ingrese el precio...">


                    <button type="submit" class="btn btn-primary ">Crear</button>

                  </fieldset>
                </form>
          </div>

        </div>

    </div>
</div>