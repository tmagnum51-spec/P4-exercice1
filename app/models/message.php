<?php
class Message
{
    private int $sender_id;
    private string $messageText;
    private string $pseudo;
    private DateTime $messageDate;

    /**
     * Getter pour l'id de l'article.
     * @return int
     */
    public function getIDRecipient(): int 
    {
        return $this->IDRecipient;
    }
}