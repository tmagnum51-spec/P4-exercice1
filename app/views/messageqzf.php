<?php require_once 'app/views/partials/header.php'; ?>

    <main class="message-grid-layout">
        <section class="form-section">
            <div class="message-users-container">
        <?php foreach($allUsers as $user): ?>
        <div class="messages-container">
            <img src="public/assets/img/<?=$user->getPicture()?>">
            <span><?=$user->getPseudo()?></span>
        </div>
        <?php endforeach; ?>


            

            
    </div>
        </section>

        <form class="chat-form-zone">
            <textarea placeholder="Votre message..."></textarea>
            <button type="submit">Envoyer</button>
        </form>
            </section>
    </main>

<?php require_once 'app/views/partials/footer.php'; ?>