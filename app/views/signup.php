
<?php require_once 'app/views/partials/header.php'; ?>
<main class="sign-container">
 
    <div class="signup-container">
        <div class="signup-details">
            <h1>Inscription</h1>

        <?php if (isset($errors['global'])): ?>
            <div class="error-global" style="color: #dc3545; font-weight: bold; margin-bottom: 15px;">
                <?php echo htmlspecialchars($errors['global']); ?>
            </div>
        <?php endif; ?>
    <form action="index.php?action=newAccount" method="POST" class="signup-form">     
        
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars($formData['pseudo'] ?? ''); ?>"placeholder="Ex : TomTrokeur">
            <?php if (isset($errors['pseudo'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['pseudo']); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" placeholder="Ex : exemple@mail.com">
            <?php if (isset($errors['email'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['email']); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••">
            <?php if (isset($errors['password'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['password']); ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit">S'inscrire</button>
        
    </form>
    <p>Déjà inscrit ? <a href="index.php?action=signin" style="text-decoration :underline;"> Connectez-vous </a></p>
        
        </div>
        <div class="signup-picture">
        <img src="public/assets/img/test.png" alt="Illustration livres">
           
        </div>
    </div>
<?php require_once 'app/views/partials/footer.php'; ?>