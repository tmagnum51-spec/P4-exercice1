<?php
Class Book extends AbstractEntity

{
    private ?int $bookId = null;
    private ?string $title = null;
    private ?string $author = null;
    private ?string $description = null;
    private ?string $status = null;
    private ?string $coverPicture = null;
    private ?int $userId = null;
    private ?string $pseudo;
    private ?string $picture;

    
    
    //accesseur
    public function getId(): ?int
        {
        return $this->bookId;
        }
    public function getTitle(): ?string
        {   
        return $this->title;}
    public function getAuthor(): ?string
        {   
        return $this->author;}
    public function getStatus(): ?string
        {   
        return $this->status;}    
    public function getdescription(): ?string
        {   
        return $this->description;} 
    public function getCoverPicture(): ?string
        {   
        return $this->coverPicture;}     

    public function getUserId(): ?int
        {
        return $this->userId;    
        }
    public function getPseudo():?string
    {
        return $this->pseudo;
    }
    public function getUserPicture():?string
        {
            return $this->picture;
        }
//mutateurs
    public function setId(?int $bookId):void
        {
        $this->bookId = $bookId;
        }

    public function setTitle(?string $title):void
        {
        $this->title = $title;
        }
    public function setAuthor(?string $author):void
    {
        $this->author = $author;
    }
    public function setDescription(?string $description):void
    {
        $this->description = $description;
    }
    public function setStatus(?string $status):void
    {
        $this->status = $status;
    }    
    public function setCoverPicture(?string $coverPicture):void
    {
        $this->coverPicture = $coverPicture;
    }   
 
    public function setUserid(?int $userId): void
    {
    $this->userId = $userId;
    }
    public function setPicture(?string $picture):void
    {
        $this->picture = $picture;
    }    
    public function setPseudo(?string $pseudo):void
    {
        $this->pseudo = $pseudo;
    }

    public function convertStatus():string{
    if ($this->getStatus() == 1 ||$this ->getStatus() === "disponible")
        {
            return "disponible";
        }
        else 
            {
                "non dispo.";
            }
    }

}