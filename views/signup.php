<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>

<div class="connection-form">
    <form action="index.php?action=connectUser" method="post" class="foldedCorner">
        <h2>Connexion</h2>
        <div class="formGrid">
            <label for="Pseudo">Pseudo</label>
            <input type="text" name="Pseudo" id="Pseudo" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">Se connecter</button>
        </div>
    </form>
</div>