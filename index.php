<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// On part du principe que l'index est à la racine, donc on vérifie le chemin
require_once 'app/Autoloader.php'; 
Autoloader::register();

$accountController= new AccountController();
$userController= new UserController();
$messageController= new MessageController();
$bookController= new BookController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        
    $bookController->showHome();
    break;

    case 'showHome':
        
    $bookController->showHome();
    break;
        
    case 'showBook':

        $bookController->showBook();
        break;
    case 'editBook':

    $bookController->editBook();
    break;

    case 'deleteBook':

    $bookController->deleteBook();
    break;
        
        
    case 'showAllBooks':
        $bookController->showAllBooks();
        break;

    case 'search':
        $bookController->searchBooks();
        break;
    
    case 'showAccount':
        $accountController->showUserAccount();
        break;

    case 'showAccountPublic':   
    $accountController->showPublicUserAccount();
    break;
    
    case 'signup':
        $userController->signUp();
        break;

    case 'newAccount':   
    $accountController->createAccount();
    break;

    case 'signin':
        $accountController->connectUser();
        break;
    
        case 'updateProfile':
        $accountController->modifyAccount();
        break;    



}