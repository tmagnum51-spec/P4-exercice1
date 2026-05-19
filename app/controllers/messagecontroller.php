<?php

class MessageController
{
    public function addMessage()
    {
        if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=signin');
        exit();
    }
        //recupération de l'id du user
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    }

    public function showMessages()
    {
        if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=signin');
        exit();
    }
    //recupération de l'id du user
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    //appel au manager
    $messageManager = new MessageManager();

    //stockage du resultat
    $messages= $messageManager->getAllMessagesById($id);

    // 4. Appel de la vue pour afficher les données
        if ($messages) {
            // C'est ici que ton fichier CSS "single-book-container" sera utilisé
            
            require_once 'app/views/message.php';
        } else {
            echo "Erreur : aucun message n'a été trouvé.";
        }
    }
}
