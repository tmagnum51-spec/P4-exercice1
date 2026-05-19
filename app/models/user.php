<?php
//declaration de la classe User
class User extends AbstractEntity
{

private int $userID;
private string $pseudo;
private string $email;
private string $picture;
private string $dateCreation;
private string $password;


//accesseur
    public function getID(): ?int
        {
        return $this->userID;
        }
    public function getPseudo(): ?string
        {   
        return $this->pseudo;}
    public function getEmail(): ?string
        {   
        return $this->email;}

    public function getPicture(): ?string 
    {
        return $this->picture;

    }    
    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }
public function getPassword():?string
    {
        return $this->password;
    }
//mutateurs
    public function setUserId(?int $userID):void
    {
        $this->userID = $userID;
    }
    public function setPseudo(?string $pseudo):void
    {
        $this->pseudo = $pseudo;
    }
    public function setEmail(?string $email):void
    {
        $this->email = $email;
    }
    public function setPicture(?string $picture):void
    {
        $this->picture = $picture;
    }
    public function setDateCreation(?string $dateCreation):void
    {
        $this->dateCreation = $dateCreation;
    } 
    public function setPassword(?string $password):void
    {
        $this->password = $password;
    }

 
}