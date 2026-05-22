<?php
//declaration de la classe UserManager

class UserManager
{
public function getUserByID(int $id) : ?User
{
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM users WHERE user_id = :id");
        $sql->execute(['id' =>$id]);
        $userDetail = $sql->fetch();
      
       
                return $userDetail ? new User($userDetail) : null;
    }
public function countBooksByUser(int $id) : int 
{
    $db= DBConnect::getPDO();
    $sql = $db->prepare("SELECT COUNT(*) FROM books WHERE fk_Id_User = :id");
    $sql->execute(['id' => $id]);
    $count = $sql->fetchColumn();

    return (int)$count;
}
public function getUserByEmail($login)
{
    
    $db= DBConnect::getPDO();
    $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
    $sql->execute(['email'=>$login]);
    $user= $sql->fetch();

        return $user ? new User($user):null;
}
public function createUser($pseudo, $email, $password, $picture):?User
{ 
    $db= DBConnect::getPDO();
    $sql= $db->prepare("INSERT INTO `users`(`pseudo`, `email`, `password`,`picture`, `date_creation`) VALUES (:pseudo, :email, :password, :picture, NOW())");
    $sql->execute(['pseudo'=>$pseudo, 'email'=>$email, 'password'=>$password, 'picture'=>$picture]);
    $lastUser=$db->lastInsertId();
    $sql=$db->prepare("SELECT * FROM users WHERE user_id = :lastUser");
    $sql->execute(['lastUser'=>$lastUser]);
    $user=$sql->fetch();

    

        return $user ? new User($user):null;

}
public function modifyUser($id, $pseudo, $email, $password, $picture):?User
{ 
    $db= DBConnect::getPDO();
    $sql= $db->prepare("UPDATE `users` SET `pseudo`=:pseudo, `email`=:email, `password`=:password, `picture`=:picture WHERE user_id=:id");
    $sql->execute(['pseudo'=>$pseudo, 'email'=>$email, 'password'=>$password, 'picture'=>$picture, 'id'=>$id]);
    $sql=$db->prepare("SELECT * FROM users WHERE `user_id` = :id");
    $sql->execute(['id'=>$id]);
    $updatedUser=$sql->fetch();

        return $updatedUser ? new User($updatedUser):null;
}



}


