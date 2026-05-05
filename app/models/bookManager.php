<?php
class BookManager
{
    public function getBookByID(int $id) : ?Book
    {
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM books WHERE id = :id");
        $sql->execute(['id' =>$id]);
        $bookDetail = $sql->fetch();
        $book = new Book;
        $book->SetID($bookDetail['id']);
        $book->SetTitle($bookDetail['title']);
        $book->SetAuthor($bookDetail['author']);
        $book->SetDescription($bookDetail['description']);
        $book->SetStatus($bookDetail['status']);
        $book->SetBookCoverPicture($bookDetail['cover_picture']);
        return $book;
        
    }

}