<?php
require_once 'Controller.php';

class BookController extends Controller
{

    public function showBook()
    {
        //recupération de l'id du livre
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        //appel au manager
        $bookManager = new BookManager();

        //stockage du resultat
        $book = $bookManager->getBookById($id);

        // 4. Appel de la vue pour afficher les données
        if ($book) {
            // C'est ici que ton fichier CSS "single-book-container" sera utilisé
            $this->render('singleBook', ['book' => $book]);
        } else {
            echo "Erreur : aucun livre n'a été trouvé.";
        }
    }
    public function searchBooks()
    {
        //recupération de la chaine de caractere de recherche 
        $search = $_GET['query'] ?? "";

        // Nettoyage de sécurité basique
        $search = trim(htmlspecialchars($search));

        // Appel au Manager (Modèle) pour récupérer les livres filtrés
        $bookManager = new BookManager();
        $allBooks = $bookManager->searchBookByTitle($search);

        // On affiche la vue
        $this->render('allBooks', ['allBooks' => $allBooks]);
    }
    public function showHome()
    {
        //appel au manager
        $bookmanager = new BookManager();

        //stockage du resultat
        $lastBooks = $bookmanager->lastBooks();

        // On charge la vue 
        $this->render('ourBooks', ['lastBooks' => $lastBooks]);
    }

    public function showAllBooks()
    {
        //appel au manager
        $bookmanager = new BookManager();

        //stockage du resultat
        $allBooks = $bookmanager->getAllBooks();

        // On charge la vue 
        $this->render('allBooks', ['allBooks' => $allBooks]);
    }
    public function editBook()
    {
        // 1. Récupération et vérification de l'existence du livre
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        if (!$book) {
            // si le livre n'existe pas en BDD, on dégage direct
            header('Location: index.php?action=showAccount&error=not_found');
            exit();
        }

        // les variables pour la vue
        $errors = [];
        $formData = [];

        // 2. Traitement du formulaire (uniquement si soumis)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // On stock ce que l'utilisateur a saisi pour lui renvoyer en cas d'erreur
            $formData = [
                'title'       => $_POST['title'] ?? '',
                'author'      => $_POST['author'] ?? '',
                'description' => $_POST['description'] ?? '',
                'status'      => $_POST['status'] ?? ''
            ];

            // validation champ par champ
            if (empty($formData['title'])) {
                $errors['title'] = "Un titre de livre est obligatoire.";
            }

            if (empty($formData['author'])) {
                $errors['author'] = "L'auteur du livre est obligatoire.";
            }

            // mise à jour
            if (empty($errors)) {

                // Gestion de l'image (on garde l'ancienne par défaut)
                $picture = $book->getCoverPicture();

                if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
                    $picture = time() . '_' . $_FILES['picture']['name'];
                    move_uploaded_file($_FILES['picture']['tmp_name'], 'public/assets/img/' . $picture);
                }

                // Mise à jour de l'objet et de la BDD
                $book->setTitle($formData['title']);
                $book->setAuthor($formData['author']);
                $book->setDescription($formData['description']);
                $book->setStatus($formData['status']);
                $book->setCoverPicture($picture);

                $bookManager->updateBook($id, $formData['title'], $formData['author'], $formData['description'], $formData['status'], $picture);

                // Redirection succès
                header('Location: index.php?action=showAccount&success=1');
                exit();
            }
        }

        // 3. on affiche la vue (Premier chargement OU retour sur erreur)
        $this->render('editBook', [
            'book'     => $book,
            'errors'   => $errors,
            'formData' => $formData
        ]);
    }


    public function newBook()
    {
        $errors = [];
        $formData = [];

        // On ne traite les données que si le formulaire a été soumis (méthode POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1. On stocke les entrées partielles pour les renvoyer à la vue
            $formData['title'] = $_POST['title'] ?? '';
            $formData['author'] = $_POST['author'] ?? '';
            $formData['description'] = $_POST['description'] ?? '';
            $formData['status'] = $_POST['status'] ?? '';

            // 2. On vérifie champ par champ et on renvoie une erreur spécifique
            if (empty(trim($formData['title']))) {
                $errors['title'] = "Un titre de livre est obligatoire.";
            }
            if (empty(trim($formData['author']))) {
                $errors['author'] = "L'auteur est obligatoire.";
            }

            // 3. Si aucune erreur, on procède à l'enregistrement
            if (empty($errors)) {
                $title = $formData['title'];
                $author = $formData['author'];
                $description = $formData['description'];
                $status = $formData['status'];
                $picture = 'newBook.png';

                if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
                    $picture = time() . '_' . $_FILES['picture']['name'];
                    move_uploaded_file($_FILES['picture']['tmp_name'], 'public/assets/img/' . $picture);
                }

                // On récupère l'id du user de la session 
                $userid = (int)$_SESSION['user']['id'];

                $bookManager = new BookManager();
                $newBook = $bookManager->addBook($picture, $title, $author, $description, $status, $userid);

                if ($newBook) {
                    $newBookId = $newBook->getId();
                    header("Location: index.php?action=showAccount");
                    exit();
                } else {
                    $errors['global'] = "Aucun livre n'a pu être créé en base de données.";
                }
            }
        }

        // 4. On transmet les erreurs et les données su formulaire à la vue
        $this->render('newBook', [
            'errors' => $errors,
            'formData' => $formData
        ]);
    }

    public function deleteBook()
    {
        //recupération de l'id du livre
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


        //appel au manager
        $bookManager = new BookManager();
        //stockage du resultat
        $book = $bookManager->deleteBookById($id);

        //echo "livre supprimé";


        header('Location: index.php?action=showAccount');
        exit;
    }
}
