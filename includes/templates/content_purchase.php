<?php

$errorMsg = '';
$article_id = $app->io->getRequest('articulo');
$name = $app->io->getPost('name');
$email = $app->io->getPost('email');
$phone = $app->io->getPost('phone');
$message = $app->io->getPost('message');

$article = $app->getArticleById($article_id);

$successId = false;
if ($article && $app->io->getPost()) {
    $successId = $app->addQuestion($app->io->getPost(), $article_id);
}

?>

<div class="container">
    <div class="well">

        <?php if (! $article) { ?>
            <div class="row mt10">
                <div class="span12">
                    <h1 class="">No se ha encontrado el articulo</h1>
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
                    <form method="post" action="" id="purchase-form">
                      <fieldset>
                          <legend>
                              Articulo:
                              <a href="index.php?page=item&id=<?php echo $article->id_article; ?>">
                                  <b><?php echo $article->title; ?></b>
                              </a>
                          </legend>
                        <?php if ($app->io->getPost()) { ?>
                            Su consulta ha sido enviada, lo contactaremos a la brevedad.
                        <?php } else { ?>
                            <div>
                                <label>Nombre</label>
                                <input type="text" name="name" placeholder="Ingrese su nombre..."/>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div>
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Ingrese su email..."/>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div>
                                <label>Telefono</label>
                                <input type="text" name="phone" placeholder="Ingrese su telefono..."/>
                                <div class="alert alert-error hide"></div>
                            </div>

                            <div>
                                <label>Mensaje</label>
                                <textarea name="message" rows="3" placeholder="Ingrese el mensaje..."></textarea>
                                <div class="alert alert-error hide"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar consulta</button>
                        <?php } ?>
                      </fieldset>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

