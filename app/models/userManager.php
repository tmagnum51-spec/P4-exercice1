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
    $count = $sql->fetchcolumn();

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

}


