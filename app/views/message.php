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



<?php require_once 'app/views/partials/footer.php'; ?>