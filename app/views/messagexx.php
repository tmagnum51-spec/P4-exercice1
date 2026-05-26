<?php require_once 'app/views/partials/header.php'; ?>
<div class="messages-container">
    <h1>Messages de <?= htmlspecialchars($messages[0]->getPseudo()) ?></h1>

    <div class="chat-box">
        <?php foreach ($messages as $message): ?>
            <div class="message-item">
                <div class="message-header">
                    <strong><?= htmlspecialchars($message->getPseudo()) ?></strong>
                    <span class="message-date">
                        <?= $message->getMessageDate()->format('d/m/Y H:i') ?>
                    </span>
                </div>
                <p class="message-text">
                    <?= nl2br(htmlspecialchars($message->getMessageText())) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    /* Petit style rapide pour vérifier que ça s'affiche bien */
    .messages-container { max-width: 600px; margin: 20px auto; font-family: 'Inter', sans-serif; }
    .message-item { background: #fff; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 8px; }
    .message-date { font-size: 0.8em; color: #999; margin-left: 10px; }
    .message-text { margin-top: 5px; color: #333; }
</style>

<?php require_once 'app/views/partials/footer.php'; ?>