<?php require_once 'app/views/partials/header.php'; ?>

<main class="account-main-container-public">
    <section class="account-container-public">
        <div class="books-grid-tex-public">
            
            <!-- Carte Gauche : Résumé Profil -->
            <article class="text-card profile-summary-public"> 
                <div class="avatar-container-public">
                    <img src="public/assets/img/<?= $userAccount->getPicture() ?>" alt="Photo de profil">
                    
                </div>
                <div class="profile-container-public">
                    <h2><?= htmlspecialchars($userAccount->getPseudo()) ?></h2>
                    <span class="membership-date">Membre depuis le :<br> <?= htmlspecialchars($userAccount->getDateCreation()) ?></span>
                    <p> <br>BIBLIOTHEQUE : </p>
                    <p> <img src=public/assets/img/livresVector.svg  style="font-size: 14px;">  <?= $bookCount ?> livres</p>
                    <a href="index.php?action=initiateDiscussion&id=<?= $userAccount->getID() ?>" class="btn-message">Message</a>
                </div>  
            </article>

            

        </div>
    </section>

    <!-- Section de la liste des livres -->
    <section class="account-bookCollection-public">    
        <article class="text-card-table-public">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                       
                    </tr>
                </thead>    
                <tbody>
                    <?php if (empty($userBooks)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">La bibliothèque est vide</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($userBooks as $book): ?>
                            <tr>
                                <td>
                                    <img src="public/assets/img/<?= $book->getCoverPicture() ?>" alt="Couverture" width="50">
                                </td>
                                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                                <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                                <td class="cell-description"><?= htmlspecialchars(strlen($book->getDescription()) > 90 ? substr($book->getDescription(), 0, 90) . '...' : $book->getDescription()) ?></td> 
                                
                            </tr>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </tbody>
            </table>
        </article>
    </section>
</main>

<?php require_once 'app/views/partials/footer.php'; ?>