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
                        <label for="book-file" style="cursor: pointer; text-decoration: underline;">
                            modifier la photo
                        </label>
                <input type="file" id="book-file" name="picture" form="edit-book-form" accept="image/png, image/jpeg" style="display: none;">
                </div>   
                <form action="index.php?action=editBook&id=<?= $book->getId() ?>" method="POST" enctype="multipart/form-data" id="edit-book-form" class="book-form">
                    
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($formData['title'] ?? $book->getTitle()); ?>" novalidate>
                            <?php if (isset($errors['title'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['title']); ?></span>
                            <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Author">autheur</label>
                        <input type="test" id="author" name="author" value="<?php echo htmlspecialchars($formData['author'] ?? $book->getAuthor()); ?>" novalidate>
                            <?php if (isset($errors['author'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['author']); ?></span>
                            <?php endif; ?>    
                    </div>

                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"><?php 
                        echo htmlspecialchars($formData['description'] ?? $book->getDescription()); ?></textarea>
                    </div>

                    <div class="form-group">
                    <label for="status">Disponibilité</label>
                    
                    <?php 
                    // On détermine quel statut doit être sélectionné (le modifié ou celui de la BDD)
                    $currentStatus = $formData['status'] ?? $book->getStatus(); 
                    ?>

                    <select id="status" name="status" required>
                        <option value="disponible" <?php echo $currentStatus === "disponible" ? 'selected' : ''; ?>>
                            Disponible
                        </option>
                        <option value="non dispo." <?php echo $currentStatus === "non dispo." ? 'selected' : ''; ?>>
                            Non dispo.
                        </option>
                    </select>
                </div>
                    <button type="submit" class="btn-submit">Valider</button>
                </form>
            </article>

        </div>
    </section>

</main>

<?php require_once 'app/views/partials/footer.php'; ?>