<?php

require_once dirname(__FILE__) . '/includes/autoload.php';

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

require_once TEMPLATES_DIR . DS . 'header.php';
require_once TEMPLATES_DIR . DS . 'menu.php';
require_once TEMPLATES_DIR . DS . 'carousel_fixed.php';
require_once TEMPLATES_DIR . DS . 'content_login.php';
require_once TEMPLATES_DIR . DS . 'footer.php';
