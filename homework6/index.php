<?php
require_once('View.php');
$v = new View();
$v->setPageTitle("Use case for the homework");
$v->setJavascriptFolder("js");
$v->setCSSFolder("styles");

$v->addJavascriptFiles(array("jquery.js", "custom.js"));
$v->addCSSFiles(array("jquery.css", "custom.css"));

$v->assignTemplateVariable("message", "Hello");
$v->assignTemplateVariable("message1", "World!");

$v->display("index.tpl");
?>