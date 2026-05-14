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
    public function getMessageText(): ?int 
    {
        return $this->messageText;
    }
    public function getPseudo(): ?int 
    {
        return $this->pseudo;
    }
    public function getMessageDate(): ?int 
    {
        return $this->messageDate;
    }

    //mutateurs
    public function setRecipientId():void
    {
        return $this->recipientId = $recipientId;

    }
    public function setSendertId():void
    {
        return $this->senderId = $senderId;

    }
    public function setMessageDate():void
    {
        return $this->messageDate = $messageDate;

    }
    public function setPseudo():void
    {
        return $this->pseudo = $pseudo;

    }
    public function setMessageText():void
    {
        return $this->messageText = $messageText;

    }
}