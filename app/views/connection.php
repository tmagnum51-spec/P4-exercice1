<?php require_once 'app/views/partials/header.php'; ?>

    <main class="registration-container">
        <section class="form-section">
            <h1 class="title">Inscription</h1>
            
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </div>

                <div class="input-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="cta-button">S'inscrire</button>
            </form>

            <p class="login-link">Déjà inscrit ? <a href="#">Connectez-vous</a></p>
        </section>

        <section class="image-section">
            <img src="../assets/pictures/bibli.png" alt="Illustration bibliothèque">
            </section>
    </main>

<?php require_once 'app/views/partials/footer.php'; ?>