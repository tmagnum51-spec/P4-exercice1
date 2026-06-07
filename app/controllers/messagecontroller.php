<?php
require_once 'Controller.php';

class MessageController extends Controller
{
    public function sendMessage()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }
        //recupération de l'id du user
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $currentUserId = $_SESSION['user']['id'];
        $messageText = isset($_POST['message_text']) ? trim($_POST['message_text']) : '';

        $messageManager = new MessageManager();
        $messageManager->insertMessageById($id, $currentUserId, $messageText);

        header('Location: index.php?action=showMessages&focus=' . $id);
        exit();
    }

    public function getCount()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }
        //recupération de l'id du user
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $currentUserId = $_SESSION['user']['id'];

        $messageManager = new MessageManager();
        $unreadCount = $messageManager->getUnreadCount($currentUserId);

        // On RENVOIE le chiffre pour qu'il soit utilisable ailleurs
        return $unreadCount;
    }




    public function showUsers()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }

        $unreadCount = $this->getCount();


        $currentUserId = (int)$_SESSION['user']['id'];
        $messageManager = new MessageManager;
        $allUsers = $messageManager->getAllUsers($currentUserId);

        $focusId = 0;
        $messages = [];

        $this->render('message', ['allUsers' => $allUsers, 'focusId' => $focusId, 'messages' => $messages]);
    }


    public function showMessages()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }
        //recupération de l'id du user
        $currentUserId = isset($_SESSION['user']) ? (int)$_SESSION['user']['id'] : 0;

        //recupération de l'id de l'utilisateur en focus
        $focusId = isset($_GET['focus']) ? (int)$_GET['focus'] : 0;

        //appel au manager
        $messageManager = new MessageManager();

        $allUsers = $messageManager->getAllUsers($currentUserId);
        $messages = $messageManager->getDiscussionByUser($currentUserId, $focusId);

        $focusedUser = null;
        foreach ($allUsers as $item) {
            if ($item['user']->getID() === $focusId) {
                $focusedUser = $item['user'];
                break;
            }
        }

        $this->render('message', [
            'allUsers'      => $allUsers,
            'messages'      => $messages,
            'focusedUser'   => $focusedUser,
            'focusId'       => $focusId,
            'currentUserId' => $currentUserId
        ]);
    }
    public function showUserDiscussion()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }
        //recupération de l'id du user connecté
        $currentUserId = isset($_SESSION['user']) ? (int)$_SESSION['user']['id'] : 0;

        //recupération de l'id de l'utilisateur a qui envoyer le message
        $id = isset($_GET['focus']) ? (int)$_GET['focus'] : 0;
        $focusId = $id;


        $currentUserId = (int)$_SESSION['user']['id'];
        $messageManager = new MessageManager;
        $messages = $messageManager->getAllMessagesByID($id, $currentUserId);
        $allUsers = $messageManager->getAllUsers($currentUserId);

        $focusedUser = null;
        foreach ($allUsers as $item) {
            if ($item['user']->getID() === $focusId) {
                $focusedUser = $item['user'];
                break;
            }
        }

        $this->render('message', [
            'allUsers'      => $allUsers,
            'messages'      => $messages,
            'focusedUser'   => $focusedUser,
            'focusId'       => $focusId,
            'currentUserId' => $currentUserId
        ]);
    }

    public function initiateDiscussion()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }

        //recupération de l'id du user connecté
        $currentUserId = (int)$_SESSION['user']['id'];

        //recupération de l'id de l'utilisateur a qui envoyer le message
        $focusId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($focusId === 0 || $focusId === $currentUserId) {
            header('Location: index.php?action=showUsers');
            exit();
        }
        $messageManager = new MessageManager();

        //on charge la partie gauche 
        $allUsers = $messageManager->getAllUsers($currentUserId);

        $focusedUser = null;
        foreach ($allUsers as $item) {
            if ($item['user']->getID() === $focusId) {
                $focusedUser = $item['user'];
                break;
            }
        }
        if ($focusedUser === null) {
            $focusedUser = $messageManager->getUserById($focusId);
        }

        //on charge la partie droite
        $messages = $messageManager->getDiscussionByUser($currentUserId, $focusId);

        $this->render('message', ['allUsers' => $allUsers, 'messages' => $messages, 'focusId' => $focusId, 'currentUserId' => $currentUserId, 'focusedUser' => $focusedUser]);
    }
}
