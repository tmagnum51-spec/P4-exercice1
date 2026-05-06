<?php
require_once '../app/autoloader.php';
Autoloader::register();

$action=$_GET['action']??'index';
if ($action==='index'){
    $controller=new HomeController();
    $controller->index();
}
// AJOUTE CETTE CONDITION :
elseif ($action === 'showBook') {
    $controller = new BookController();
    $controller->showBook();
}