<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define("DIRETORIO_RAIZ", dirname(__FILE__));

require_once('vendor/autoload.php');

use Controle\Dispatcher;

$dispatcher = new Dispatcher();
$app = $dispatcher->iniciarApp();
$dispatcher->appAjax == true ?  $dispatcher->requisitarAjax() : $dispatcher->renderizarApp();

