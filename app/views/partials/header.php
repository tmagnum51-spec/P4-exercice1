<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>    
<div class="nav-container">  
    <header class="header">
        <section class="nav-group-left">
            <div class="logo">
                <div class="logo-icon">
                    <a href="index.php?action=showHome">
                    <span class="t-first">T</span>
                    <span class="t-second">T</span>
                    </a>
                </div>
                <a href="index.php?action=showHome"> <span class="logo-text">Tom Troc</span></a>
            </div>
            <nav>
                <a href="index.php?action=showHome">Accueil</a>
                <a href="index.php?action=showAllBooks">Nos livres à l'échange</a>
            </nav>
        </section>
        <section class="nav-group-right">
            <nav>    
                    <a href="index.php?action=showUsers" class="nav-message-link"><svg class="icon-messagerie" width="14" height="14" viewBox="-1 -1 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.5 6.5C13.5 9.8 10.6 12.5 7 12.5C5.8 12.5 4.7 12.2 3.7 11.6L0.5 12.5L1.6 9.6C0.9 8.7 0.5 7.6 0.5 6.5C0.5 3.2 3.4 0.5 7 0.5C10.6 0.5 13.5 3.2 13.5 6.5Z" 
              stroke="#292929" 
              stroke-width="0.71" 
              stroke-linecap="round" 
              stroke-linejoin="round"/>
    </svg> Messagerie 
                        <?php if (isset($unreadCount) && $unreadCount > 0): ?>
                        <span class="message-counter">
                            <div class="text-counter">
                            <?php echo $unreadCount; ?>
                        </div>
                        </span>
                        <?php endif; ?></a>
                    <a href="index.php?action=showAccount"><img src="public/assets/img/mon compte.svg"> Mon compte</a>
                    <a href="index.php?action=signup">Connexion</a>
            </nav>
        </section>
    </header>
</div>