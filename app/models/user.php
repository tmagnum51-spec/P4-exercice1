<?php
//declaration de la classe User
class User
{

Private int $userID;
private string $pseudo;
private string $email;
private string $picture;

//accesseur
    public function getID(): ?int
        {
        return $this->userID;
        }
    public function getName(): ?string
        {   
        return $this->Pseudo;}
    public function getEmail(): ?string
        {   
        return $this->email;}

    public function getPicture(): ?string 
    {
        return $this->picture;

    }    

//mutateurs
    Public function setID(?int $userID):void
    {
        $this->userID = $userID;
    }

    Public function setName(?string $pseudo):void
    {
        $this->pseudo = $pseudo;
    }
    Public function setEmail(?string $email):void
    {
        $this->email = $email;
    }
    public function setPicture(?string $picture):void
    {
        $this->picture = $picture;
    }

 
}