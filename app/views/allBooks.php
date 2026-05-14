<?php require_once 'app/views/partials/header.php'; ?>
<main class="container">
<section class="allBooksTitle-container">
    <div class="allBooksTitle-title">
        <h2>Nos livres à l'échange</h2>
    </div>     
       <div class="search-form-books"> 
        <form action="index.php" method="GET">
            <input type="hidden" name="action" value="search">
            
            <div class="search-wrapper">
                <input type="text" name="query" placeholder="Rechercher un livre..." class="search-field">
                
                <button type="submit" class="search-icon-btn">
                    <i class="fa-solid fa-magnifying-glass" style="color: #9A9A9A;"></i>
                </button>
            </div>
        </form>
    </div>

    </section>

            <div class="books-grid">
                <?php foreach($allBooks as $book): ?>
                    <article class="book-card">
                        <a href="index.php?action=showBook&id=<?= $book->getId() ?>">
                        <img src="public/assets/img/<?= $book->getCoverPicture() ?>" alt="<?= $book->getTitle() ?>">
                        <h3><?= $book->getTitle() ?></h3>
                        <p><?= $book->getAuthor() ?></p>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

<?php require_once 'app/views/partials/footer.php'; ?>