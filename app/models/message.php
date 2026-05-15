<?php
class Message extends AbstractEntity
{
    private int $sender_Id;
    private int $recipient_Id;
    private string $messageText;
    private string $pseudo;
    private DateTime $messageDate;

    
   //accesseur
    public function getRecipientId(): ?int 
    {
        return $this->recipientId;
    }
    public function getSenderId(): ?int 
    {
        return $this->senderId;
    }
    public function getMessageText(): ?string
    {
        return $this->messageText;
    }
    public function getPseudo(): ?string 
    {
        return $this->pseudo;
    }
    public function getMessageDate(): ?DateTime
    {
        return $this->messageDate;
    }

    //mutateurs
    public function setRecipientId(?int $recipientId):void
    {
        $this->recipientId = $recipientId;

    }
    public function setSendertId(?int $senderId):void
    {
        $this->senderId = $senderId;

    }
  
    public function setMessageDate(string|DateTime $messageDate): void
    {
    // Si on reçoit une string (ce qui arrive lors de l'hydratation depuis la DB)
    if (is_string($messageDate)) {
        $this->messageDate = new DateTime($messageDate);
    } else {
        // Si c'est déjà un objet DateTime
        $this->messageDate = $messageDate;
    }
    }
    public function setPseudo(?string $pseudo):void
    {
        $this->pseudo = $pseudo;

    }
    public function setMessageText(?string $messageText):void
    {
        $this->messageText = $messageText;

    }
}