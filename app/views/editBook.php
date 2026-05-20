<?php require_once 'app/views/partials/header.php'; ?>

<main class="account-main-container">
    <section class="editBook-container">
        <nav class="breadcrumb">
            <a href="index.php?action=showAccount">← Retour </a>
        <h1>Modifier les informations</h1>
        <div class="books-grid-text">
       
            <article class="text-card editBook-form-card"> 
                <div class="edit-book-picture-container">
                    <p>Photo</p>
                    <img src="public/assets/img/<?=$book->getCoverPicture()?>">
                    <span>modifier la photo</span>
                </div>   
                <form action="index.php?action=updateBook" method="POST" class="book-form">
                    
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Author">autheur</label>
                        <input type="test" id="author" name="author" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Commentaire</label>
                        <textarea id="description" name="description" required><?= htmlspecialchars($book->getDescription()) ?>
                        </textarea>    
                    </div>

                    <div class="form-group">
                        <label for="dispo">Disponibilité</label>
                        <!-- Remplacement de l'input par le vrai menu déroulant <select> -->
                        <select id="dispo" name="disponibilite" required>
                            <option value="1" <?= $book->getStatus() == 1 ? 'selected' : '' ?>>Disponible</option>
                            <option value="0" <?= $book->getStatus() == 0 ? 'selected' : '' ?>>Non dispo.</option>
                           
                        </select>
                    </div> 
                    <button type="submit" class="btn-submit">Valider</button>
                </form>
            </article>

        </div>
    </section>

</main>

<?php require_once 'app/views/partials/footer.php'; ?>