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
            $this->render('message', ['messages' => $messages]);
        } else {
            // Plutôt que de bloquer avec un echo, on peut charger la vue qui affichera "Aucun message"
            $error = "Aucun message n'a été trouvé.";
            $this->render('message', ['messages' => $messages, 'error' => $error]);
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


        $userId = (int)$_SESSION['user']['id'];

        // Appels aux Managers
        $bookCount = 0;
        $userManager = new UserManager();
        $userAccount = $userManager->getUserByID($userId);
        $bookCount = $userManager->countBooksByUser($userId);

        $bookManager = new BookManager();
        $userBooks = $bookManager->getAllBooksbyUser($userId);

        // Envoi à la vue
        $this->render('account', ['userAccount' => $userAccount, 'bookCount' => $bookCount, 'userBooks' => $userBooks]);
    }
    public function showPublicUserAccount()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
            exit();
        }


        $userId = (int)($_GET['id'] ?? 0);

        // Appels aux Managers
        $userManager = new UserManager();
        $userAccount = $userManager->getUserByID($userId);
        $bookCount = $userManager->countBooksByUser($userId);

        $bookManager = new BookManager();
        $userBooks = $bookManager->getAllBooksbyUser($userId);

        // Envoi à la vue
        $this->render('accountPublic', ['userAccount' => $userAccount, 'bookCount' => $bookCount, 'userBooks' => $userBooks]);
    }

    /**
     * Traite le formulaire de connexion
     */
    public function connectUser(): void
    {
        $errors = [];
        $formData = [];

        // On ne traite les données que si le formulaire a été soumis (méthode POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1. On stocke les entrées partielles pour les renvoyer à la vue            
            $formData['email'] = $_POST['email'] ?? '';
            $formData['password'] = $_POST['password'] ?? '';

            // 2. On vérifie champ par champ et on renvoie une erreur spécifique           
            if (empty(trim($formData['email']))) {
                $errors['email'] = "L'email est obligatoire.";
            }

            if (empty(trim($formData['password']))) {
                $errors['password'] = "Un mot de passe est obligatoire.";
            }

            // 3. Si aucune erreur, on procède à la verification
            if (empty($errors)) {
                $email = $formData['email'];
                $password = $formData['password'];

                $userManager = new UserManager();
                $realUser = $userManager->getUserByEmail($email);

                // On vérifie les identifiants
                if ($realUser && password_verify($password, $realUser->getPassword())) {
                    $_SESSION['user'] = [
                        'id'           => $realUser->getId(),
                        'email'        => $realUser->getEmail(),
                        'pseudo'       => $realUser->getPseudo(),
                        'dateCreation' => $realUser->getDateCreation(),
                        'picture'      => $realUser->getPicture()
                    ];
                    header('Location: index.php?action=showAccount');
                    exit();
                } else {
                    // Mauvais mot de passe ou email inconnu
                    $errors['global'] = "identifiant ou mot de passe incorrect.";
                }
            }
        }
        // 4. On transmet les erreurs et les données du formulaire à la vue 

        $this->render('signin', [
            'errors' => $errors,
            'formData' => $formData
        ]);
    }



    public function createAccount()
    {
        $errors = [];
        $formData = [];

        // On ne traite les données que si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1. On stocke les entrées partielles pour les renvoyer à la vue
            $formData['pseudo'] = $_POST['pseudo'] ?? '';
            $formData['email'] = $_POST['email'] ?? '';
            $formData['password'] = $_POST['password'] ?? '';

            // 2. On vérifie champ par champ et on renvoie une erreur spécifique
            if (empty(trim($formData['pseudo']))) {
                $errors['pseudo'] = "Le pseudo est obligatoire.";
            }
            if (empty(trim($formData['email']))) {
                $errors['email'] = "L'email est obligatoire.";
            }

            if (empty(trim($formData['password']))) {
                $errors['password'] = "Un mot de passe est obligatoire.";
            }

            // 3. Si aucune erreur, on procède à l'enregistrement
            if (empty($errors)) {
                $pseudo = $formData['pseudo'];
                $email = $formData['email'];
                $hashedPassword = password_hash($formData['password'], PASSWORD_ARGON2ID);
                $picture = 'defaultUser.png';

                $userManager = new UserManager();
                $newUser = $userManager->createUser($pseudo, $email, $hashedPassword, $picture);

                if ($newUser) {
                    $_SESSION['user'] = [
                        'id'           => $newUser->getId(),
                        'email'        => $newUser->getEmail(),
                        'pseudo'       => $newUser->getPseudo(),
                        'dateCreation' => $newUser->getDateCreation(),
                        'picture'      => $newUser->getPicture()
                    ];

                    header('Location: index.php?action=showAccount');
                    exit();
                } else {
                    $errors['global'] = "Une erreur est survenue lors de la création du compte.";
                }
            }
        }

        // 4. On transmet  à la vue 

        $this->render('signup', [
            'errors' => $errors,
            'formData' => $formData
        ]);
    }
    public function modifyAccount()
    {
        $id = (int)$_SESSION['user']['id'];
        $userManager = new UserManager();
        $user = $userManager->getUserByID($id);

        $errors = [];

        // On verifie si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1. Vérifications des champs
            if (empty(trim($_POST['pseudo'] ?? ''))) {
                $errors['pseudo'] = "Le pseudo est obligatoire.";
            }
            if (empty(trim($_POST['email'] ?? ''))) {
                $errors['email'] = "L'email est obligatoire.";
            }

            // 2. Si aucune erreur, on traite
            if (empty($errors) && $user) {
                $pseudo = trim($_POST['pseudo']);
                $email = trim($_POST['email']);

                // password
                $password = !empty($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_ARGON2ID) : $user->getPassword();

                // image
                $picture = $user->getPicture();
                if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
                    $picture = time() . '_' . $_FILES['picture']['name'];
                    move_uploaded_file($_FILES['picture']['tmp_name'], 'public/assets/img/' . $picture);
                }


                $newUser = $userManager->modifyUser($id, $pseudo, $email, $password, $picture);

                if ($newUser) {
                    $_SESSION['user'] = [
                        'id'           => $newUser->getID(), // Utilise getID() comme défini dans ton entité
                        'email'        => $newUser->getEmail(),
                        'pseudo'       => $newUser->getPseudo(),
                        'dateCreation' => $newUser->getDateCreation(),
                        'picture'      => $newUser->getPicture()
                    ];
                    header('Location: index.php?action=showAccount');
                    exit();
                } else {
                    $errors['global'] = "Une erreur est survenue lors de la modification.";
                }
            }
        }

        // 3. envoi a la vue
        $bookManager = new BookManager();
        $this->render('account', [
            'errors'      => $errors,
            'userAccount' => $user,
            'userBooks'   => $bookManager->getAllBooksbyUser($id),
            'bookCount'   => $userManager->countBooksByUser($id)
        ]);
    }
}
