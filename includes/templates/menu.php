<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
      <div class="container">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="brand" href="index.php?page=home"><img class="logo-caja" src="assets/images/logo1.png"></a>
        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class=""><a href="index.php?page=home">Principal</a></li>
            <li><a href="index.php?page=about">Quienes somos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php foreach($app->getArticleCategories() as $category) { ?>
                  <li><a href="index.php?page=articles-by-category&id=<?php echo $category->id_article_category; ?>"><?php echo $category->name; ?></a></li>
                <?php } ?>
                <!--
                <li class="divider"></li>
                <li class="nav-header">Tipos de ventas</li>
                <li><a href="#">Desde la maqueta o plano (Solo proyecto)</a></li>
                <li><a href="#">Desde el terreno o pozo con ubicacion confirmada</a></li>
                <li><a href="#">Durante la construccion</a></li>
                <li><a href="#">Construccion finalizada</a></li>
                -->
              </ul>
            </li>
            <li><a href="index.php?page=contact">Contacto</a></li>
          </ul>
          <ul class="nav pull-right">
            <li class="">
                <a href="index.php?page=login"><?php echo $app->io->getSession('username') ? 'Logueado como: <b>' . $app->io->getSession('username') . '</b>': 'Iniciar sesion'; ?></a>
            </li>
          </ul>
        </div>
      </div>
      </div>
    </div>

  </div>
</div>
