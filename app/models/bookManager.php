<?php
class BookManager
{
    public function getBookByID(int $id) : ?Book
    {
        $db= DBConnect::getPDO();
        $sql = $db->prepare("SELECT b.*, u.pseudo, u.picture, u.user_Id AS userid FROM books b LEFT JOIN users u ON b.fk_Id_User = u.user_Id WHERE b.id = :id
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
    public function deleteBookById(int $id)
    {
        $db = DBConnect::getPDO();
        $request= $db->prepare("DELETE FROM `books` WHERE id = :id");
        $request->execute(['id'=>$id]);
                       


    }
    public function updateBook($id, $title, $author, $description, $status, $picture):?Bool
    {
        $db= DBConnect::getPDO();
        $sql= $db->prepare("UPDATE `books` SET `title`=:title, `author`=:author, `description`=:description,`status`=:status, `cover_picture`=:picture WHERE id=:id");
        $updatedBook=$sql->execute(['id'=>$id, 'title'=>$title, 'author'=>$author, 'description'=>$description, 'status'=>$status, 'picture'=>$picture]);
        

        return $updatedBook; 
    }      
    public function addBook($picture, $title, $author, $description, $status, $userid):?Book
    {
        $db= DBConnect::getPDO();
        $sql= $db->prepare("INSERT INTO `books` (`cover_picture`, `title`, `author`, `description`, `fk_Id_User`, `status`) VALUES (:picture,:title,:author,:description,:userid,:status)");
        $sql->execute(['picture'=>$picture, 'title'=>$title, 'author'=>$author, 'description'=>$description,'userid'=>$userid, 'status'=>$status]);
        $lastBook=$db->lastInsertId();
        $sql=$db->prepare("SELECT * FROM books WHERE id = :lastBook");
        $sql->execute(['lastBook'=>$lastBook]);
        $newBook=$sql->fetch();

        return $newBook ? new Book($newBook):null;
        }
           
    

}

 