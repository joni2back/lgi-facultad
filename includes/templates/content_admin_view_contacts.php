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
            <li class="active">Ver consultas</li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <h3>Ultimas consultas</h3>
                <dl class="">
                    <?php foreach($app->getQuestions() as $question) { ?>
                        <dt class="mb10">
                            <big><?php echo $question->article_title; ?></big>
                            (<?php echo $question->article_category; ?> - <?php echo $question->article_type; ?>) -
                            <a href="index.php?page=item&id="<?php echo $question->article_id; ?>">Ir al articulo</a>
                        </dt>
                        <dd>
                            <p><?php echo $question->message; ?></p>
                            <ul class="unstyled">
                                <li><b>Nombre:</b> <?php echo $question->name; ?></li>
                                <li><b>Email:</b> <?php echo $question->email; ?></li>
                                <li><b>Telefono:</b> <?php echo $question->phone; ?></li>
                                <li><b>IP:</b> <?php echo $question->ip; ?></li>
                            </ul>
                        </dd>
                        <hr />
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

