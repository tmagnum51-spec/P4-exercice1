<?php require_once 'app/views/partials/header.php'; ?>

        <main>
        <div class="hero">
            <section class="Intro">
                <h2>Rejoignez nos lecteurs passionnés</h2>
                    <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. 
                        Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. 
                    </p>
                    <form action="index.php?action=listBooks" method="POST"><button type="submit" class="cta-button">Découvrir</button></form>
            </section>
                       
        <section class="intro-picture"> 
        <img src="public/assets/img/intro-picture.jpg" alt="Illustration livres"></section>
        </div>

        <section class="latest-books">
            <h2>Les derniers livres ajoutés</h2>
        

            <div class="books-grid">
                <?php foreach($lastBooks as $book): ?>
                    <article class="book-card">
                        <img src="public/assets/img/<?= $book->getCoverPicture() ?>" alt="<?= $book->getTitle() ?>">
                        <h3><?= $book->getTitle() ?></h3>
                        <p><?= $book->getAuthor() ?></p>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="container-btn">
                <form action="index.php?action=listbooks method="POST"><button type"submit" class="cta-button">Voir tous les livres</a>
            </div>
        </section>
        <section class="latest-books">
            <h2>Comment ça marche ?</h2>
            <h4>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</h4>
        

            <div class="books-grid">
                
                    <article class="book-card">                                               
                    <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
                    </article>
                    <article class="book-card">                                               
                    <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                    </article>
                    <article class="book-card">                                               
                    <p>Parcourez les livres disponibles chez d'autres membres.</p>
                    </article>
                    <article class="book-card">                                               
                    <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                    </article>
            </div>

            <div class="container-btn">
                <form action="index.php?action=listbooks method="POST"><button type"submit" class="btn-discover">Voir tous les livres</a>
            </div>
        </section>
        <section class="banner-container">
            <div class="banner-img">
                <img src="public/assets/img/banner.png" alt= "Bibliotheque">
            </div>
        </section>
        <section class="values-container">
            <div class="values-title">
                Nos valeurs
            </div>
                <div class="values-content">
                Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
                Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. 
                Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.   
                </div>
                    <div class="values-signature">
                        L’équipe Tom Troc
                    </div>
        </section>
    <?php require_once 'app/views/partials/footer.php'; ?>