<?php require_once 'app/views/partials/header.php'; ?>

<div class="messaging-container" style="display: flex; min-height: 80vh;">

    <div class="sidebar-users" style="width: 20%; border-right: 1px solid #rgba(250, 249, 247, 1); padding: 20px;">
        <h3>Messagerie</h3>
        <?php if (!empty($allUsers)): ?>
            <?php foreach($allUsers as $item): ?>
                <?php 
                    $uId = $item['user']->getID();
                    $pseudo = $item['user']->getPseudo();
                    $avatar = !empty($item['user']->getPicture()) ? $item['user']->getPicture() : 'default.png';
                    $textExtrait = $item['message']->getMessageText();
                    $dateMessage = $item['message']->getMessageDate()->format('H:i');
                ?>
                <a href="index.php?action=showMessages&focus=<?= $uId ?>" class="user-link" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; text-decoration: none; color: inherit;">
                    <img src="public/assets/img/<?= $avatar ?>" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                    <div class="user-info">
                            <div class="user-name-date" style=display: inline-flex; font-family: inter; font-weight: 400; font-size: 12px;>
                            <span style="display: inline-flex; padding-right: 50px;  "><?= htmlspecialchars($pseudo)?></span>
                            <span><?= htmlspecialchars($dateMessage)?></span>
                            </div>
                        <span style="font-size: 0.85em; color: #888;"><?= htmlspecialchars(substr($textExtrait, 0, 20)) ?>...</span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: #999;">Aucune discussion active.</p>
        <?php endif; ?>
    </div>

    <div class="chat-area" style="width: 80%; padding: 20px; display: flex; flex-direction: column;">
        <?php if (isset($focusId) && $focusId > 0): ?>
            <div class="nameAndpicture" style="display:inline-flex; padding-right:20px; align-items: center;">
            <img src="public/assets/img/<?= $avatar ?>"style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; margin-right:20px;">
            <?= htmlspecialchars($pseudo)?>
            </div>
            <div class="chat-messages-container" style="flex: 1; background: #fafafa; padding: 20px; border-radius: 8px; margin-bottom: 20px; min-height: 350px;">

                <?php if (!empty($messages) && is_array($messages)): ?>
                    <?php foreach($messages as $message): ?>
                        
                        <?php 
                            $senderId = $message->getSenderId();
                            $isMe = ($senderId === $currentUserId); 
                            
                            // 🎯 SÉCURITÉ DATE : On vérifie que c'est bien un objet DateTime avant de faire ->format()
                            $dateObj = $message->getMessageDate();
                            $heure = '';
                            if ($dateObj instanceof DateTime) {
                                $heure = $dateObj->format('H:i');
                            }
                        ?>

                        <div class="message-row" style="text-align: <?= $isMe ? 'right' : 'left' ?>; margin-bottom: 15px;">
                            <div class="message-bubble" style="display: inline-block; background: <?= $isMe ? '#rgba(166, 166, 166, 1)' : 'rgb(255, 255, 255)' ?>; color: #333; padding: 12px 18px; border-radius: 15px; max-width: 65%; text-align: left; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                <p style="margin: 0; font-size: 0.95em;"><?= htmlspecialchars($message->getMessageText()) ?></p>
                                
                                <?php if (!empty($heure)): ?>
                                    <span class="message-time" style="display: block; font-size: 0.75em; color: #999; margin-top: 5px; text-align: right;">
                                        <?= $heure ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #999; text-align: center; margin-top: 100px;">Aucun message dans cette discussion.</p>
                <?php endif; ?>
            </div>

            <form action="index.php?action=sendMessage&id=<?= $focusId ?>" method="POST" class="chat-form" style="display: flex; gap: 10px;">
                <input type="text" name="message_text" placeholder="Votre message..." autofocus required style="flex: 1; padding: 12px; border: none; solid #rgba(0, 172, 102, 1); border-radius: 6px;">
                <button type="submit" style="padding: 12px 24px; background: rgba(0, 172, 102, 1); color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Envoyer</button>
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