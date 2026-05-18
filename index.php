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
elseif ($action === 'showHome') {
    $controller = new BookController();
    $controller->showHome();
}
elseif ($action === 'showAllBooks') {
    $controller = new BookController();
    $controller->showAllBooks();
}
elseif ($action === 'search') {
$controller = new BookController();
$controller->searchBooks();

}
elseif ($action === 'showMessages') {
$controller = new MessageController();
$controller->showMessages();

}
elseif ($action === 'signup') {
$controller = new UserController();
$controller->signUp();

}
elseif ($action === 'signin') {
$controller = new UserController();
$controller->signin();

}
elseif ($action === 'showUserAccount') {
$controller = new AccountController();
$controller->showUserAccount();
}