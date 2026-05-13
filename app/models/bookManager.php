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
        $allLines = $request->fetchAll();

        foreach($allLines as $line){
            $oneBook =new Book($line);
          
            $allTheBooks[]=$oneBook; 
        }
        return $allTheBooks;
    }
    public function searchBookByTitle(string $search)
    {
        $foundBooks = [];
        $db = DBConnect::getPDO();
        $sql = $db->prepare("SELECT * FROM books WHERE title LIKE :search OR author LIKE :search");
        $searchTerm = "%" . $search . "%";

        $sql->execute(['search'=>$searchTerm]);
        $searchBooks=$sql->fetchAll();

        foreach($searchBooks as $line) 
            {
                $oneBook= new Book($line);

                $foundBooks[]=$oneBook;
            }
            return $foundBooks;
    }
    
    public function lastBooks():?array
    {
    $lastBooks = [];
    $db = DBConnect::getPDO();
    $request = $db->prepare('SELECT * FROM books ORDER BY id DESC LIMIT 4;');
    $request->execute();
    $allLines = $request->fetchAll();

    foreach($allLines as $line){
        $last1Book =new Book($line);
        
        $lastBooks[]=$last1Book; 
    }
    return $lastBooks;
    }

}