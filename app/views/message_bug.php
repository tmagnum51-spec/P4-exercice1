<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require_once 'app/views/partials/header.php'; ?>

   
<div class="sidebar-users">
    <?php if (!empty($allUsers) && is_array($allUsers)): ?>
        <?php foreach($allUsers as $item): ?>
            <a href="index.php?action=showMessages&focus=<?= $item['user']->getUserId() ?>">
                <img src="public/assets/img/<?= $item['user']->getPicture() ?>" alt="Avatar" style="width:40px; height:40px; border-radius:50%;">
                <span><?= htmlspecialchars($item['user']->getPseudo()) ?></span>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="padding: 10px; color: #888; font-size: 0.9em;">Aucune discussion active.</p>
    <?php endif; ?>
</div>

<div class="chat-area">
    <?php if ($focusId > 0): ?>
        
        <div class="chat-messages-container">
            <?php foreach($messages as $message): ?>
                <div class="message-bubble <?= $message->getSenderId() === $currentUserId ? 'my-message' : 'other-message' ?>">
                    <p><?= htmlspecialchars($message->getMessageText()) ?></p>
                    <span class="message-time"><?= $message->getMessageDate()->format('H:i') ?></span>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        
        <div class="no-discussion-selected">
            <p>Sélectionnez un contact dans la liste pour démarrer une discussion.</p>
        </div>

    <?php endif; ?>

    <?php if ($focusId > 0): ?>
    <form action="index.php?action=sendMessage&id=<?= $focusId ?>" method="POST" class="chat-form">
    
    <input type="text" name="message_text" placeholder="Votre message..." autofocus required>
    
    <button type="submit">Envoyer</button>
    </form>
    <?php endif; ?>
</div>


<p style="background: yellow; color: black; padding: 10px;">
    Coucou, PHP arrive jusqu'ici !
</p>

<?php require_once 'app/views/partials/footer.php'; ?>