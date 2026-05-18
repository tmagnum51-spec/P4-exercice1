<?php
class AccountController
{
public function showAccountMessages()
    {
    //recupération de l'id du user
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    //appel au manager//
    $accountManager = new accountManager();

    //stockage du resultat//
    $messages= $accountManager->getAllMessagesById($id);

    // 4. Appel de la vue pour afficher les données
        if ($messages) {
           
            
            require_once 'app/views/message.php';
        } else {
            echo "Erreur : aucun message n'a été trouvé.";
        }
    }
    public function showUserAccount()
    {
        // 🎯 SIMULATION TEMPORAIRE : On démarre la session et on crée un faux utilisateur connecté
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Remplace 1 par l'ID d'un utilisateur qui existe vraiment dans ta base PhpMyAdmin
    $_SESSION['userId'] = 1;

    //On recupère soit une id soit la session
        $userId = (int)($_GET['id'] ?? $_SESSION['userId'] ?? 0);
    
        // On fait appel au UserManager
        $userManager = new UserManager();
        $userAccount= $userManager->getUserByID($userId);
        $bookCount= $userManager->countBooksByUser($userId);

        //on fait appel au BookManager pour la collection de livres
        $bookManager = new BookManager();
        $userBooks= $bookManager->getAllBooksbyUser($userId);
        
        
        
        //On envoie à la vue
        require_once 'app/views/account.php';


    }
}