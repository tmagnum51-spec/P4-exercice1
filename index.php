<?php
// On part du principe que l'index est à la racine, donc on vérifie le chemin
require_once 'app/Autoloader.php'; 
Autoloader::register();

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $controller = new HomeController();
    $controller->index();
} 
// AJOUTE CETTE CONDITION :
elseif ($action === 'showBook') {
    $controller = new BookController();
    $controller->showBook();
}