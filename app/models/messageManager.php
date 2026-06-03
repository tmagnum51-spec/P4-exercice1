<?php
class MessageManager
{

public function getUnreadCount(int $currentUserId):int
{
    $db= DBConnect::getPDO();
    $sql= $db->prepare("SELECT COUNT(*) FROM messages WHERE recipient_id=:currentUserId AND is_read=0");
    $sql->execute(['currentUserId'=>$currentUserId]);
    $count= $sql->fetchcolumn();

    return $count;

}

public function getAllUsers(int $currentUserId):array
    {
     $allUsers = [];
     $db= DBConnect::getPDO();
     $sql=$db->prepare("
        SELECT DISTINCT u.user_id, u.pseudo, u.picture
        FROM users u
        JOIN messages m ON (m.sender_id = u.user_id OR m.recipient_id = u.user_id)
        WHERE (m.sender_id = :id OR m.recipient_id = :id)
        AND u.user_id != :id
        ORDER BY m.message_date DESC
    ");
     $sql->execute(['id'=>$currentUserId]);
     $alllines= $sql->fetchall();

     $allUsers= [];

     foreach($alllines as $line)
        {
            $allUsers[] = [
            'user'    => new User($line), 
            'message' => $this->getLastMessage($currentUserId, $line['user_id'])
        ];
        }
     return $allUsers;

    }
    public function getLastMessage(int $currentUserId, int $targetUserId): Message
{
    $db = DBConnect::getPDO();
    $sql = $db->prepare("SELECT * FROM messages 
                         WHERE (sender_id = :curr AND recipient_id = :target) 
                         OR (sender_id = :target AND recipient_id = :curr)
                         ORDER BY message_date DESC LIMIT 1");
    
    $sql->execute(['curr' => $currentUserId, 'target' => $targetUserId]);
    $line = $sql->fetch();
    
    return $line ? new Message($line) : new Message(['message_text' => 'Aucun message']);
}

    public function getDiscussionByUser(int $currentUserId, $focusUserId)
 {
    $db = DBConnect::getPDO();
    
    
    $userDiscussion = [];
       
    // On sélectionne TOUS les messages du duo, du plus ancien au plus récent
    $sql = $db->prepare("SELECT id, sender_id, recipient_id, message_text, message_date 
        FROM messages 
        WHERE (sender_id = :current_id AND recipient_id = :focus_id)
           OR (sender_id = :focus_id AND recipient_id = :current_id)
        ORDER BY message_date ASC
    ");
    
    // On injecte les deux étiquettes
    $sql->execute([
        'current_id' => $currentUserId,
        'focus_id'   => $focusUserId
    ]);
    
    $allLines = $sql->fetchAll();

    $userDiscussion = [];

    foreach($allLines as $line) {
        
        $userDiscussion[] = new Message($line);
    }
    
    return $userDiscussion; 
}
public function getAllMessagesByID(int $id, int $currentUserId) : ?array
    {   
        $allTheMessages = [];
        $db= DBConnect::getPDO();

        
    //on met a jour les messages qui vont être récupérés
    $sqlUpdate=$db->prepare("UPDATE  messages SET is_read=1 WHERE recipient_id=:currentUserId AND sender_id=:focusUserId AND is_read=0");
    $sqlUpdate->execute(['currentUserId'=>$currentUserId , 'focusUserId'=>$id]);



        $sql = $db->prepare("SELECT m.*, u.picture, u.pseudo FROM messages m INNER JOIN users u ON m.recipient_id = u.user_id AND m.sender_id = :currentUserId OR m.sender_id = u.user_id AND recipient_id = :currentUserId WHERE u.user_id = :id ORDER BY m.message_date ASC");
        $sql->execute(['id' =>$id, 'currentUserId'=>$currentUserId]);
        $allLines = $sql->fetchall();
        foreach($allLines as $line){
            $oneMessage =new Message($line);
          
            $allTheMessages[]=$oneMessage; 
    }
        return $allTheMessages;
       
                
    }

public function insertMessageById(int $id, int $currentUserId,string $messageText)
{
  $db= DBConnect::getPDO();
        $sql= $db->prepare("INSERT INTO `messages` (`message_text`, `recipient_id`, `sender_id`, `message_date`) 
        VALUES (:messageText, :recipientId, :senderId, NOW())");
        $sql->execute(['messageText'=>$messageText, 'recipientId'=>$id,'senderId'=>$currentUserId]);
       
         // On sélectionne TOUS les messages du duo, du plus ancien au plus récent
        $sql = $db->prepare("SELECT id, sender_id, recipient_id, message_text, message_date 
        FROM messages 
        WHERE (sender_id = :current_id AND recipient_id = :focus_id)
           OR (sender_id = :focus_id AND recipient_id = :current_id)
        ORDER BY message_date ASC
    ");
    
    // On injecte les deux étiquettes
    $sql->execute([
        'current_id' => $currentUserId,
        'focus_id'   => $id
    ]);
    
    $allLines = $sql->fetchAll();

    $userDiscussion = [];

    foreach($allLines as $line) {
        
        $userDiscussion[] = new Message($line);
    }
    
    return $userDiscussion; 

}
public function getUserByID(int $id) : ?User
{
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM users WHERE user_id = :id");
        $sql->execute(['id' =>$id]);
        $userDetail = $sql->fetch();
      
       
                return $userDetail ? new User($userDetail) : null;
    }
}