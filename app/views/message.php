<div class="page-messagerie-wrapper">
    <?php require_once 'app/views/partials/header.php'; ?>

    <div class="messaging-container">
        <div class="sidebar-users">
            <h3>Messagerie</h3>
            <?php if (!empty($allUsers)): ?>
                <?php foreach($allUsers as $item): ?>
                    <?php 
                        $uId = $item['user']->getID();
                        $pseudo = $item['user']->getPseudo();
                        $avatar = !empty($item['user']->getPicture()) ? $item['user']->getPicture() : 'default.png';
                        $textExtrait = $item['message'] ? $item['message']->getMessageText() : 'Aucun message';
                        $dateMessage = $item['message'] ? $item['message']->getMessageDate()->format('H:i') : '';
                    ?>
                    <a href="index.php?action=showMessages&focus=<?= $uId ?>" class="user-link <?= ($focusId === $uId) ? 'active' : '' ?>">
                        <img src="public/assets/img/<?= htmlspecialchars($avatar) ?>" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                        <div class="user-info">
                            <div class="user-name-date">
                                <span><?= htmlspecialchars($pseudo) ?></span>
                                <span><?= htmlspecialchars($dateMessage) ?></span>
                            </div>
                            <span style="font-size: 0.85em; color: #888;"><?= htmlspecialchars(substr($textExtrait, 0, 20)) ?>...</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #999;">Aucune discussion active.</p>
            <?php endif; ?>
        </div>

        <div class="chat-area">
            <?php if (isset($focusedUser) && $focusedUser instanceof User): ?>
                <div class="chat-header">
                    <img src="public/assets/img/<?= htmlspecialchars($focusedUser->getPicture() ?? 'default.png') ?>" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                    <?= htmlspecialchars($focusedUser->getPseudo()) ?>
                </div>

                <div class="chat-messages-container">
                    <?php if (!empty($messages) && is_array($messages)): ?>
                        <?php foreach($messages as $message): ?>
                            <?php 
                                $isMe = ($message->getSenderId() === $currentUserId); 
                                $dateObj = $message->getMessageDate();
                                $heure = ($dateObj instanceof DateTime) ? $dateObj->format('H:i') : '';
                            ?>
                            <div class="message-row <?= $isMe ? 'row-me' : 'row-other' ?>">
                                <div class="message-bubble <?= $isMe ? 'bubble-me' : 'bubble-other' ?>">
                                    <p><?= htmlspecialchars($message->getMessageText()) ?></p>
                                    <?php if (!empty($heure)): ?>
                                        <span class="message-time" style="display: block; font-size: 0.75em; color: #999; text-align: right;"><?= $heure ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #999; text-align: center; margin-top: 100px;">Aucun message dans cette discussion.</p>
                    <?php endif; ?>
                </div>

                <form action="index.php?action=sendMessage&id=<?= (int)$focusId ?>" method="POST" class="chat-form">
                    <input type="text" name="message_text" placeholder="Votre message..." autofocus required>
                    <button type="submit">Envoyer</button>
                </form>

            <?php else: ?>
                <div class="no-discussion-selected" style="text-align: center; margin-top: 150px; color: #777;">
                    <h3 style="color: #385170;">Bienvenue dans votre messagerie</h3>
                    <p>Sélectionnez un contact dans la liste de gauche pour afficher l'historique et démarrer une discussion.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once 'app/views/partials/footer.php'; ?>
</div>