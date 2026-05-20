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
                <form action="index.php?action=editBook&id=<?= $book->getId() ?>" method="POST" class="book-form">
                    
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
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
                        <label for="status">Disponibilité</label>
                        <!-- Remplacement de l'input par le vrai menu déroulant <select> -->
                        <select id="status" name="status" required>
                            <option value="disponible" <?= $book->getStatus() == "disponible" ? 'selected' : '' ?>>Disponible</option>
                            <option value="non dispo." <?= $book->getStatus() == "non dispo." ? 'selected' : '' ?>>Non dispo.</option>
                           
                        </select>
                    </div> 
                    <button type="submit" class="btn-submit">Valider</button>
                </form>
            </article>

        </div>
    </section>

</main>

<?php require_once 'app/views/partials/footer.php'; ?>