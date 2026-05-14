<?php
//declaration de la classe UserManager

class UserManager
{
public function getUserByID(int $id) : ?User
{
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM users WHERE id = :id");
        $sql->execute(['id' =>$id]);
        $userDetail = $sql->fetch();
      
       
                return $userDetail ? new User($userDetail) : null;
    }
}


