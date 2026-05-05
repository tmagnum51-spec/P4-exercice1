<?php
class Book
{
    private int $bookID;
    private string $bookTitle;
    private string $bookAuthor;
    private string $bookDescription;
    private string $bookStatus;
    private string $bookCoverPicture;
    private int $bookOwnerID;

    //accesseur
    public function getID(): ?int
        {
        return $this->bookID;
        }
    public function getTitle(): ?string
        {   
        return $this->bookTitle;}
    public function getAuthor(): ?string
        {   
        return $this->bookAuthor;}
    public function getbookStatus(): ?string
        {   
        return $this->bookStatus;}    
    public function getbookDescription(): ?string
        {   
        return $this->bookDescription;} 
    public function getBookCoverPicture(): ?string
        {   
        return $this->bookCoverPicture;}     

    public function getOwnerID(): ?int
        {
        return $this->ownerID;    
        }

//mutateurs
    Public function setID(?int $bookID):void
        {
        $this->bookID = $bookID;
        }

    Public function setTitle(?string $bookTitle):void
        {
        $this->bookTitle = $bookTitle;
        }
    Public function setAuthor(?string $bookAuthor):void
    {
        $this->bookAuthor = $bookAuthor;
    }
     Public function setDescription(?string $bookDescription):void
    {
        $this->bookDescription = $bookDescription;
    }
    Public function setBookStatus(?string $bookStatus):void
    {
        $this->bookStatus = $bookStatus;
    }    
    Public function setBookCoverPicture(?string $bookCoverPicture):void
    {
        $this->bookCoverpicture = $bookCoverPicture;
    }   
     Public function setOwnerID(?int $bookOwnerID):void
    {
        $this->bookOwnerID = $bookOwnerID;
    }    


}