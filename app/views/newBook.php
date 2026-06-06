<?php require_once 'app/views/partials/header.php'; ?>

<main class="account-main-container">
    <section class="editBook-container">
        <nav class="breadcrumb">
            <a href="index.php?action=showAccount">← Retour </a>
        <h1>Ajouter un livre</h1>
        <div class="books-grid-text">
       
            <article class="text-card editBook-form-card"> 
                <div class="edit-book-picture-container">
                    <p>Photo</p>
                    <img src="public/assets/img/newBook.png">
                        <label for="book-file" style="cursor: pointer; text-decoration: underline;">
                            modifier la photo
                        </label>
                <input type="file" id="book-file" name="picture" form="edit-book-form" accept="image/png, image/jpeg" style="display: none;">
                </div>   
                <form action="index.php?action=newBook" method="POST" enctype="multipart/form-data" id="edit-book-form" class="book-form">
                    
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($formData['title'] ?? ''); ?>" placeholder="Titre" novalidate>
                            <?php if (isset($errors['title'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($errors['title']); ?></span>
                            <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Author">autheur</label>
                        <input type="test" id="author" name="author" value="<?php echo htmlspecialchars($formData['author'] ?? ''); ?>" placeholder="Autheur" novalidate>
                             <?php if (isset($errors['author'])): ?>
                                <span class="error-message"><?php echo htmlspecialchars($errors['author']); ?></span>
                                <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Commentaire</label>
                        <textarea id="description" name="description">  <?php echo htmlspecialchars($formData['description'] ?? ''); ?>
                        </textarea>    
                    </div>

                    <div class="form-group">
                        <label for="status">Disponibilité</label>
                        <!-- Remplacement de l'input par le vrai menu déroulant <select> -->
                        <select id="status" name="status" required>
                            <option value="disponible" >Disponible</option>
                            <option value="non dispo." >Non dispo.</option>
                           
                        </select>
                    </div> 
                    <button type="submit" class="btn-submit">Valider</button>
                </form>
            </article>

        </div>
    </section>

</main>

<?php require_once 'app/views/partials/footer.php'; ?>