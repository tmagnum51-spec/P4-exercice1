<?php
require_once '../app/autoloader.php';
Autoloader::register();

$action=$_GET['action']??'index';
if ($action==='index'){
    $controller=new HomeController();
    $controller->index();
}
// AJOUTE CETTE CONDITION :
elseif ($action === 'showHome') {
    $controller = new BookController();
    $controller->showBook();
}