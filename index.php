<?php

require_once dirname(__FILE__) . '/includes/autoload.php';

$sectionFile = 'content_' . $app->getSectionName() . '.php';
$carouselType = $app->getSectionName() == 'home' ? 'carousel_dynamic.php' : 'carousel_fixed.php';

require_once TEMPLATES_DIR . DS . 'header.php';

if ($app->getSectionName() != 'index') {
    require_once TEMPLATES_DIR . DS . 'menu.php';
    //require_once TEMPLATES_DIR . DS . $carouselType;
}

if (file_exists(TEMPLATES_DIR . DS . $sectionFile)) {
    require_once TEMPLATES_DIR . DS . $sectionFile;
} else {
    require_once TEMPLATES_DIR . DS . 'content_404.php';
}

require_once TEMPLATES_DIR . DS . 'footer.php';