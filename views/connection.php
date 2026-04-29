<?php
    /**
     * formulaire de connexion.
     */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Tom Troc</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <script src="../scripts/script.js" defer></script>
</head>
<body>

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
            </section>
    </main>

</body>
</html>