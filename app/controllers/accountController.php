<?php
require_once 'Controller.php';

class AccountController extends Controller
{
    /**
     * Affiche la messagerie de l'utilisateur connecté
     */
    public function showAccountMessages()
    {
        // 1. Sécurité : accès réservé aux membres
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }

        // 2. Récupération de l'ID : Soit celui de l'URL, soit celui du user connecté en session
        $id = (int)($_GET['id'] ?? $_SESSION['user']['id'] ?? 0);

        // 3. Appel au manager (Attention aux majuscules selon tes classes : AccountManager ou accountManager)
        $accountManager = new AccountManager();
        $messages = $accountManager->getAllMessagesById($id);

        // 4. Appel de la vue
        if ($messages) {
            $this->render('message', ['messages'=>$messages]);
           
        } else {
            // Plutôt que de bloquer avec un echo, on peut charger la vue qui affichera "Aucun message"
            $error = "Aucun message n'a été trouvé.";
            $this->render('message', ['messages'=>$messages, 'error'=>$error]);

           
        }
    }

    /**
     * Affiche le profil de l'utilisateur (Infos + ses livres)
     */
    public function showUserAccount()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }

        // Corrigé ici : on pioche dans $_SESSION['user']['id'] qui est créée lors du login
        $userId = (int)$_SESSION['user']['id'];
    
        // Appels aux Managers
        $bookCount=0;
        $userManager = new UserManager();
        $userAccount = $userManager->getUserByID($userId);
        $bookCount = $userManager->countBooksByUser($userId);

        $bookManager = new BookManager();
        $userBooks = $bookManager->getAllBooksbyUser($userId);
        
        // Envoi à la vue
        $this->render('account', ['userAccount'=>$userAccount, 'bookCount'=>$bookCount, 'userBooks'=>$userBooks]);
        
    }
    public function showPublicUserAccount()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }

        // Corrigé ici : on pioche dans $_SESSION['user']['id'] qui est créée lors du login
        $userId = (int)($_GET['id'] ?? 0);
    
        // Appels aux Managers
        $userManager = new UserManager();
        $userAccount = $userManager->getUserByID($userId);
        $bookCount = $userManager->countBooksByUser($userId);

        $bookManager = new BookManager();
        $userBooks = $bookManager->getAllBooksbyUser($userId);
        
        // Envoi à la vue
        $this->render('accountPublic', ['userAccount'=>$userAccount, 'bookCount'=>$bookCount, 'userBooks'=>$userBooks]);
        
    }

    /**
     * Traite le formulaire de connexion
     */
    public function connectUser() : void 
    {
        $login = NULL;
        $password = NULL;
        $error = NULL;

        // 1. On vérifie que les champs ne sont pas vides 
        if (!empty($_POST['email']) && !empty($_POST['password'])) 
        {
            // On récupère les données propres
            $login = trim($_POST['email']);
            $password = trim($_POST['password']);

            $userManager = new UserManager();
            $realUser = $userManager->getUSerByEmail($login);

            // 2. On vérifie les identifiants
            if ($realUser && password_verify($password, $realUser->getPassword())) {
                $_SESSION['user'] = [
                    'id'           => $realUser->getID(), 
                    'email'        => $realUser->getEmail(), 
                    'pseudo'       => $realUser->getPseudo(),
                    'dateCreation' => $realUser->getDateCreation(),
                    'picture'      => $realUser->getPicture()
                ];
                header('Location: index.php?action=showAccount');
                exit();
            } else {
                // Mauvais mot de passe ou email inconnu
                $error = "Identifiants ou mot de passe incorrects.";
            }
        } else {
            // Le formulaire n'est pas rempli (ou premier affichage de la page)
            $error = "Veuillez remplir tous les champs.";
        }

        // 3. Quoi qu'il arrive, si on n'est pas redirigé (erreur ou premier chargement), on affiche la vue
        $this->render('signin',['error'=>$error]);
        
    }
    public function createAccount(){
    // 1. On vérifie que les champs ne sont pas vides 
        if (!empty($_POST['pseudo']) &&  !empty($_POST['email']) && !empty($_POST['password'])) 
            {

            // On récupère les données propres
            $pseudo=trim($_POST['pseudo']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $picture='defaultUser.png'; 

            $userManager = new UserManager();
            $newUser = $userManager->createUser($pseudo, $email, $password, $picture);
            
                if ($newUser) {
                $_SESSION['user'] = [
                        'id'           => $newUser->getID(), 
                        'email'        => $newUser->getEmail(), 
                        'pseudo'       => $newUser->getPseudo(),
                        'dateCreation' => $newUser->getDateCreation(),
                        'picture'      => $newUser->getPicture()
                    ];


                header('Location: index.php?action=showAccount');
                exit();
                }
        else 
        {
            echo "Une erreur est survenue lors de la création du compte.";  
        }
    }
    else 
        {
            echo "Tous les champs doivent être remplis";
        }

    }
    public function modifyAccount(){
        // On récupère l'ID de l'utilisateur connecté en session
            $id = (int)$_SESSION['user']['id'];

            $userManager= new UserManager();

        // 1. On vérifie que les champs ne sont pas vides 
        if (!empty($_POST['pseudo']) &&  !empty($_POST['email'])) 
            {
            $user= $userManager->getUserById($id);
                      
            // On récupère les données propres
            $pseudo=trim($_POST['pseudo']);
            $email = trim($_POST['email']);


            if ($user) {

            // --- GESTION DU MOT DE PASSE ---
            // Si le champ password n'est pas vide, on prend le nouveau et on le hache
            if (!empty($_POST['password'])) {
                $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            } else {
                // S'il est vide, on récupère le mot de passe actuel déjà présent en BDD
                $password = $user->getPassword(); 
            }
             
            //On recupère l'image du User
            $picture = $user->getPicture();


            //On recupère l'image si l'utilisateur en a mis une    
              if(isset($_FILES['picture'])&& $_FILES['picture']['error'] === 0){
            $picture = time() . '_' . $_FILES['picture']['name'];

            move_uploaded_file($_FILES['picture']['tmp_name'], 'public/assets/img/' . $picture);
            }

            //On hydrate avec les divers infos
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setPicture($picture);
            
            //On envoie au manager pour insertion dans la table
            $newUser = $userManager->modifyUser($id, $pseudo, $email, $password, $picture);
            }
            //On met a jour la session avec l'utilisateur modifié    
                if ($newUser) {
                $_SESSION['user'] = [
                        'id'           => $newUser->getID(), 
                        'email'        => $newUser->getEmail(), 
                        'pseudo'       => $newUser->getPseudo(),
                        'dateCreation' => $newUser->getDateCreation(),
                        'picture'      => $newUser->getPicture()
                    ];

            //On redirige vers la page du compte modifié
                header('Location: index.php?action=showAccount');
                exit();
                }
        else 
        {
            echo "Une erreur est survenue lors de la modification du compte.";  
        }
    }
    else 
        {
            echo "Tous les champs doivent être remplis";
        }

    }
    
} // Fin de la classe AccountController