<?php

abstract class Controller

{
    // method pour recupérer le compteur unread et afficher les vues
public function render(string $viewName, array $data =[])
{
$unreadCount = 0;

    if (isset($_SESSION['user'])) {
        $messageManager = new MessageManager();
        $unreadCount = $messageManager->getUnreadCount((int)$_SESSION['user']['id']);
}
extract($data);

require_once 'app/views/partials/header.php';
require_once 'app/views/' . $viewName . '.php';
require_once 'app/views/partials/footer.php';

}
}