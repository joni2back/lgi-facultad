<?php

$errorMsg = '';
$articleId = $app->io->getRequest('articulo');
$article = $app->getArticleById($articleId);


if (! $article) {
    $errorMsg = 'No se ha encontrado el articulo';
}
?>

<div class="container">
    <div class="well">

        <?php if (! $article) { ?>
            <div class="row mt10">
                <div class="span12">
                    <h1 class=""><?php echo $errorMsg; ?></h1>
                </div>
            </div>

        <?php } else { ?>

            <ul class="breadcrumb well">
                <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
                <li class="active">Contacto por compra</li>
            </ul>

            <h1>Contacto por compra</h1>
            <div class="row">
                <div class="span5">
                    <img src="assets/images/contact-big-icon.png" alt="" style="width:100%"/>
                </div>
                <div class="span5">
                    <form method="post" action="">
                      <fieldset>
                          <legend>
                              Item:
                              <a href="index.php?page=item&id=<?php echo $article->id; ?>">
                                  <b><?php echo $article->title; ?></b>
                              </a>
                          </legend>
                        <?php if ($app->io->getPost()) { ?>
                            Su consulta ha sido enviada, lo contactaremos a la brevedad.
                        <?php } else { ?>
                            <label>Nombre</label>
                            <input type="text" name="name" placeholder="Ingrese su nombre...">
                            <label>Email</label>
                            <input type="text" placeholder="Ingrese su email...">
                            <label>Telefono</label>
                            <input type="text" placeholder="Ingrese su telefono...">
                            <label>Mensaje</label>
                            <textarea rows="3"></textarea>

                            <label class="radio">
                              <input type="radio" name="contact_type" checked="checked" disabled="disabled"> Contacto por compra
                            </label>
                            <button type="submit" class="btn">Enviar consulta</button>
                        <?php } ?>
                      </fieldset>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div><!-- /.container -->

