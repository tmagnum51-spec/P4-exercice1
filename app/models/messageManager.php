<?php
class MessageManager
{
    public function getAllMessagesByID(int $id) : ?array
    {   
        $allTheMessages = [];
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT m.*, u.picture, u.pseudo FROM messages m INNER JOIN users u ON m.recipent_Id = u.user_id WHERE u.user_id = :id");
        $sql->execute(['id' =>$id]);
        $allLines = $sql->fetchall();
        foreach($allLines as $line){
            $oneMessage =new Message($line);
          
            $allTheMessages[]=$oneMessage; 
    }
        return $allTheMessages;
       
                
    }
}