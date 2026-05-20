<?php

class BookController
{

public function showBook()
{
//recupération de l'id du livre
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

//appel au manager
$bookManager = new BookManager();

//stockage du resultat
$book= $bookManager->getBookById($id);

// 4. Appel de la vue pour afficher les données
    if ($book) {
        // C'est ici que ton fichier CSS "single-book-container" sera utilisé
        require_once 'app/views/singleBook.php';
    } else {
        echo "Erreur : aucun livre n'a été trouvé.";
    }
}
      public function searchBooks()
    {
       //recupération de la chaine de caractere de recherche 
$search = $_GET['query']??"";

// 2. Nettoyage de sécurité basique
$search = trim(htmlspecialchars($search));

// 3. Appel au Manager (Modèle) pour récupérer les livres filtrés
$bookManager = new BookManager();
$allBooks = $bookManager->searchBookByTitle($search);

// 4. On affiche la vue
require_once 'app/views/allBooks.php';
  
    }
public function showHome()
{
//appel au manager
$bookmanager = new BookManager();

//stockage du resultat
$lastBooks= $bookmanager->lastBooks();

// On charge la vue 
require_once 'app/views/ourBooks.php';
}

public function showAllBooks()
{
//appel au manager
$bookmanager = new BookManager();

//stockage du resultat
$allBooks= $bookmanager->getAllBooks();

// On charge la vue 
require_once 'app/views/allBooks.php';
}
public function editBook()
{
//recupération de l'id du livre
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

//appel au manager
$bookManager = new BookManager();

//stockage du resultat
$book= $bookManager->getBookById($id);

// 4. Appel de la vue pour afficher les données
    if ($book) {
        // C'est ici que ton fichier CSS "single-book-container" sera utilisé
        require_once 'app/views/editBook.php';
    } else {
        echo "Erreur : aucun livre n'a été trouvé.";
    }
}
public function deleteBook(){
    //recupération de l'id du livre
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    //appel au manager
    $bookManager = new BookManager();
    //stockage du resultat
    $book= $bookManager->deleteBookById($id);
       
        header('Location:index.php?action=showAccount');
    exit;
    }


}