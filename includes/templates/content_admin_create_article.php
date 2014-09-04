<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

$title = $app->io->getPost('title');
$description = $app->io->getPost('description');
$id_article_category = $app->io->getPost('id_article_category');
$id_article_type = $app->io->getPost('id_article_type');
$location = $app->io->getPost('location');
$address = $app->io->getPost('address');
$price = $app->io->getPost('price');

$successId = false;
if ($app->io->getPost('title')) {
    $successId = $app->addArticle($app->io->getPost(), $app->io->getSession('user')->id);
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
                <?php if ($successId) { ?>
                    <h2>Se creo correctamente el articulo!</h2>
                    <h3>Acciones: </h3>
                    <ul class="">
                        <li><a href="index.php?page=item&id=<?php echo $successId; ?>">Ir al articulo</a></li>
                        <li><a href="index.php?page=item&id=<?php echo $successId; ?>">Editarlo</a></li>
                        <li><a href="index.php?page=admin-create-article" class="">Crear otro articulo</a></li>
                    </ul>
                <?php } else { ?>
                    <form method="post" action="" class="">
                      <fieldset>
                        <legend>Nuevo articulo</legend>

                        <div>
                            <label>Titulo</label>
                            <input type="text" name="title" placeholder="Ingrese el titulo..." class="span12" value="<?php echo $title; ?>" />
                            <div class="alert alert-error hide"></div>
                        </div>

                        <div>
                            <label>Descripcion</label>
                            <textarea rows="3" cols="10" name="description" placeholder="Ingrese el contenido..." class="span12"><?php echo $description; ?></textarea>
                            <div class="alert alert-error hide"></div>
                        </div>

                        <div class="row-fluid">
                            <div class="span6">
                                <label>Categoria</label>
                                <select name="id_article_category" class="span12">
                                    <option value="">Seleccione la categoria...</option>
                                    <?php foreach($app->getArticleCategories() as $category) { ?>
                                        <option <?php echo $category->id == $id_article_category ? 'selected="selected"':''; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div class="span6">
                                <label>Tipo</label>
                                <select name="id_article_type" class="span12">
                                    <option value="">Seleccione el tipo...</option>
                                    <?php foreach($app->getArticleTypes() as $type) { ?>
                                        <option <?php echo $type->id == $id_article_type ? 'selected="selected"':''; ?> value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="alert alert-error hide"></div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span4">
                                <label>Localidad</label>
                                <input type="text" name="location" placeholder="Ingrese la localidad..." class="span12" value="<?php echo $location; ?>"/>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div class="span4">
                                <label>Direccion</label>
                                <input type="text" name="address" placeholder="Ingrese el telefono..." class="span12" value="<?php echo $address; ?>"/>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div class="span4">
                                <label>Precio</label>
                                <input type="text" name="price" placeholder="Ingrese el precio..." class="span12" value="<?php echo $price; ?>"/>
                                <div class="alert alert-error hide"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Crear</button>

                      </fieldset>
                    </form>
                <?php } ?>
          </div>

        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        $('.alert.alert-error').hide().html('');
        var hasErrors = false;
        $(this).find('input, select, textarea').each(function() {
            if (! $(this).val()) {
                hasErrors = true;
                var input = $(this);
                input.parent().find('.alert.alert-error').show().css('margin-bottom','15px')
                    .html('<i class="icon-chevron-up"></i> Por favor complete el campo');
            }
        });
        hasErrors && e.preventDefault();
    });
});
</script>