<?php
class BookManager
{
    public function getBookByID(int $id) : ?Book
    {
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM books WHERE id = :id");
        $sql->execute(['id' =>$id]);
        $bookDetail = $sql->fetch();
      
       
                return $bookDetail ? new Book($bookDetail) : null;
    }
    public function getAllBooks(): array
    {
        $allTheBooks = [];
        $db = DBConnect::getPDO();
        $request = $db->prepare('SELECT * FROM `books`');
        $request->execute();
        $allLines = $request->fetchall();

        foreach($allLines as $line){
            $oneBook =new book($line);
          
            $allTheBooks[]=$oneBook; 
        }
        return $allTheBooks;
    }
    public function modifyBook()
    {


    }

}