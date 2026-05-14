<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book->getTitle()) ?></title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>

    <div class="single-book-container">
        <div class="book-image-section" style="background-image: url('public/assets/img/<?= $book->getCoverPicture() ?>');"></div>
        
        <div class="book-content-section">
            <h1 class="title"><?= htmlspecialchars($book->getTitle()) ?></h1>
            <p class="book-author">par <?= htmlspecialchars($book->getAuthor()) ?></p>
            
            <div class="divider"></div>

            <p class="section-label">Description</p>
            <p class="book-description-text">
                <?= nl2br(htmlspecialchars($book->getDescription())) ?>
            </p>

            <p class="section-label">Propriétaire</p>
            <div class="owner-info">
                <img src="../pictures/avatar.png" class="owner-avatar" alt="Avatar">
                <span class="owner-name"><?= nl2br(htmlspecialchars($book->getOwnerId())) ?></span>
            </div>

            <button class="cta-button">Envoyer un message</button>
        </div>
    </div>