<?php require_once 'app/views/partials/header.php'; ?>

<main class="account-main-container">
    <section class="account-container">
        <div class="books-grid-text">
            
            <!-- Carte Gauche : Résumé Profil -->
            <article class="text-card profile-summary"> 
                <div class="avatar-container">
                    <img src="public/assets/img/<?= $userAccount->getPicture() ?>" alt="Photo de profil">
                </div>
                <div class="profile-container">
                    <h2><?= htmlspecialchars($userAccount->getPseudo()) ?></h2>
                    <span class="membership-date">Membre depuis le :<br> <?= htmlspecialchars($userAccount->getDateCreation()) ?></span>
                    <p> <br>BIBLIOTHEQUE : </p>
                    <p> <img src=public/assets/img/livresVector.svg style="font-size: 14px;">  <?= $bookCount ?>  livres</p>
                </div>  
            </article>

            <!-- Carte Droite : Formulaire de Modification -->
            <article class="text-card profile-form-card"> 
                <form action="index.php?action=updateProfile" method="POST" class="account-form">
                    
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" placeholder="<?= htmlspecialchars($userAccount->getPseudo()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" placeholder="<?= htmlspecialchars($userAccount->getEmail()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-submit">Enregistrer les modifications</button>
                </form>
            </article>

        </div>
    </section>

    <!-- Section de la liste des livres -->
    <section class="account-bookCollection">    
        <article class="text-card-table">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>Disponibilité</th>
                        <th>Action</th>
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
                                <td class="cell-description"><?= htmlspecialchars(strlen($book->getDescription()) > 360 ? substr($book->getDescription(), 0, 360) . '...' : $book->getDescription()) ?></td> 
                                <td><?php 
                                        $status = $book->getStatus();
                                        // On nettoie et on met en minuscule pour comparer facilement
                                        $statusClass = ($status === 'disponible') ? 'badge-available' : 'badge-unavailable';
                                        ?>
                                        <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($status) ?></span></td>
                                <td>
                                    <a href="index.php?action=editBook&id=<?= $book->getId() ?>">Éditer</a>
                                    <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" onclick="return confirm('Supprimer ce livre ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </tbody>
            </table>
        </article>
    </section>
</main>

<?php require_once 'app/views/partials/footer.php'; ?>