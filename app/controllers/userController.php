<?php

class UserController
{
    public function showUser()
    {
        //recupération de l'id du livre
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        //appel au manager
        $userManager = new UserManager();

        //stockage du resultat
        $user = $userManager->getUserById($id);
    }
    public function signUp()
    {
        require_once 'app/views/signUp.php';
    }
    public function signIn()
    {
        require_once 'app/views/signIn.php';
    }
}
