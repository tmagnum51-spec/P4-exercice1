<?php
class Book
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

    public function __construct(array $data = []) 
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * @return void
     */
    protected function hydrate(array $data) : void 
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
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
    Public function setId(?int $bookId):void
        {
        $this->bookId = $bookId;
        }

    Public function setTitle(?string $title):void
        {
        $this->title = $title;
        }
    Public function setAuthor(?string $author):void
    {
        $this->author = $author;
    }
     Public function setDescription(?string $description):void
    {
        $this->description = $description;
    }
    Public function setStatus(?string $status):void
    {
        $this->status = $status;
    }    
    Public function setCoverPicture(?string $coverPicture):void
    {
        $this->coverPicture = $coverPicture;
    }   
     Public function setUserId(?int $userId):void
    {
        $this->userId = $userId;
    }    
    Public function setPicture(?string $picture):void
    {
        $this->picture = $picture;
    }    
    public function setPseudo(?string $pseudo):void
    {
        $this->pseudo = $pseudo;
    }


}