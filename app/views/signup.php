
<?php require_once 'app/views/partials/header.php'; ?>
<main class="sign-container">
 
    <div class="signup-container">
        <div class="signup-details">
            <h1>Inscription</h1>
    <form action="index.php?action=newAccount" method="POST" class="signup-form">     
        
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Ex : TomTrokeur" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="Ex : exemple@mail.com" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-submit">S'inscrire</button>
        
    </form>
    <p>Déjà inscrit ? <a href="index.php?action=signin" style="text-decoration :underline;"> Connectez-vous </p>
        
        </div>
        <div class="signup-picture">
        <img src="public/assets/img/test.png" alt="Illustration livres">
           
        </div>
    </div>
<?php require_once 'app/views/partials/footer.php'; ?>