<?php

include "TemplateContext.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$context = new TemplateContext();
$context->assignVar('title', 'Test page');
$context->assignVar('content', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr');

echo $context->render('template.html');
?>  