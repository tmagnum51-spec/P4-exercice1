
<?php require_once 'app/views/partials/header.php'; ?>
<main class="container">
    <nav class="breadcrumb">
    <ol>
        <li><a href="index.php?action=showAllBooks">Nos livres</a></li>
        <li class="separator">></li>
        <li class="current">The Kinfolk Table</li>
    </ol>
</nav>
    <div class="book-container">
       <div class="book-cover" style="background-image: url('public/assets/img/<?= $book->getCoverPicture() ?>');">
        </div>
        
        <div class="book-details">
            <h1 class="title"><?= htmlspecialchars($book->getTitle()) ?></h1>
            <p class="book-author">par <?= htmlspecialchars($book->getAuthor()) ?></p>
            
            <div class="divider"></div>

            <p class="section-label">Description</p>
            <p class="book-description-text">
                <?= nl2br(htmlspecialchars($book->getDescription())) ?>
            </p>

            <p class="section-label">Propriétaire</p>
            <div class="owner-info">
                <img src="public/assets/img/<?= htmlspecialchars($book->getUserPicture()) ?>" class="owner-avatar" alt="Avatar">
                <span class="owner-name"><?= nl2br(htmlspecialchars($book->getPseudo())) ?></span>
            </div>

            <button class="cta-button">Envoyer un message</button>
        </div>
    </div>
<?php require_once 'app/views/partials/footer.php'; ?>