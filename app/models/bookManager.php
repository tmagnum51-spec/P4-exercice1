<?php
class BookManager
{
    public function getBookByID(int $id) : ?Book
    {
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT b.*, u.pseudo, u.picture FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_Id WHERE b.id = :id
    ");
        $sql->execute(['id' =>$id]);
        $bookDetail = $sql->fetch();
      
       
                return $bookDetail ? new Book($bookDetail) : null;
    }
    public function getBookByUser(int $id) : ?Book
    {
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT b.*, u.pseudo, u.picture FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_id WHERE b.fk_Id_User = :userId
    ");
        $sql->execute(['userId' =>$id]);
        $bookDetail = $sql->fetch();
      
       
                return $bookDetail ? new Book($bookDetail) : null;
    }
    public function getAllBooks(): array
    {
        $allTheBooks = [];
        $db = DBConnect::getPDO();
        $request = $db->prepare('SELECT b.*, u.pseudo, u.picture FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_Id');
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
        $sql = $db->prepare("SELECT b.*, u.pseudo, u.picture FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_Id WHERE title LIKE :search OR author LIKE :search");
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
    $request = $db->prepare('SELECT b.*, u.pseudo, u.picture FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_Id ORDER BY b.id DESC LIMIT 4');
    $request->execute();
    $allLines = $request->fetchAll();

    foreach($allLines as $line){
        $last1Book =new Book($line);
        
        $lastBooks[]=$last1Book; 
    }
    return $lastBooks;
    }
public function getAllBooksbyUser(int $id): array
    {
        $allTheUserBooks = [];
        $db = DBConnect::getPDO();
        $request = $db->prepare('SELECT b.*, u.pseudo, u.picture, u.user_id FROM books b INNER JOIN users u ON b.fk_Id_User = u.user_id WHERE u.user_id = :id');
        $request->execute(['id'=>$id]);
        $allLines = $request->fetchAll();

        foreach($allLines as $line){
            $oneBook =new Book($line);
          
            $allTheUserBooks[]=$oneBook; 
        }
        return $allTheUserBooks;
    }
    public function countBooksByUser(int $id) : int 
    {
        $sql = "SELECT COUNT(*) FROM books WHERE fk_Id_User = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $count = $result->fetchcolumn();

        return (int)$count;
    }
}
 