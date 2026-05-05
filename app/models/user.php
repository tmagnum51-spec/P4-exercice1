<?php
//declaration de la classe User
class User
{

Private int $userID;
private string $pseudo;
private string $email;

//accesseur
    public function getID(): ?int
        {
        return $this->userID;
        }
    public function getName(): ?string
        {   
        return $this->userPseudo;}
    public function getEmail(): ?string
        {   
        return $this->userEmail;}

//mutateurs
    Public function setID(?int $userID):void
    {
        $this->userID = $userID;
    }

    Public function setName(?string $userPseudo):void
    {
        $this->userPseudo = $userPseudo;
    }
    Public function setEmail(?string $userEmail):void
    {
        $this->userEmail = $userEmail;
    }

 
}