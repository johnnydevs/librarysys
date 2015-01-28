<?php

/**
 * AdminModels
 * Handles data for admin pages 
 */
class AdminModel
{
    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create($title_text, $category, $author, $isbn, $subtitle, $publicationYear, $pageCount, $description)
    {
        // clean the input to prevent for example javascript within the notes.
        $title_text = strip_tags($title_text);
        $category = strip_tags($category);
        $author = strip_tags($author);
        $isbn = strip_tags($isbn);
        $subtitle = strip_tags($subtitle);
        $publicationYear = strip_tags($publicationYear);
        $pageCount = strip_tags($pageCount);
        $description = strip_tags($description);

        $sql = "INSERT INTO book (title, category, author, isbn, subtitle, publicationYear, pageCount, description) 
                VALUES (:title, :category, :author, :isbn, :subtitle, :publicationYear, :pageCount, :description)";
        $query = $this->db->prepare($sql);
        $query->execute(array(  ':title' => $title_text, 
                                ':category' => $category,
                                ':author' => $author, 
                                ':isbn' => $isbn,
                                ':subtitle' => $subtitle,
                                ':publicationYear' => $publicationYear,
                                ':pageCount' => $pageCount,
                                ':description' => $description
                                ));

        $count =  $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_ADD_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }
    
    //get a list of all archived books
    public function getArchivedBooks()
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.publicationYear,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        WHERE archive = '1' ORDER BY id DESC LIMIT 15");
        $sth->execute();

        $all_books = array();

        foreach ($sth->fetchAll() as $book) {
            // a new object for every user. This is eventually not really optimal when it comes
            // to performance, but it fits the view style better
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->author = $book->author;
            $all_books[$book->id]->category = $book->cat_name;
            $all_books[$book->id]->isbn = $book->isbn;

        }
        return $all_books;
    }
    
    public function getDeletedBooks()
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.publicationYear,
        b.bin,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        WHERE bin = '1' ORDER BY id DESC LIMIT 15");
        $sth->execute();

        $all_books = array();

        foreach ($sth->fetchAll() as $book) {
            // a new object for every user. This is eventually not really optimal when it comes
            // to performance, but it fits the view style better
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->author = $book->author;
            $all_books[$book->id]->category = $book->cat_name;
            $all_books[$book->id]->isbn = $book->isbn;

        }
        return $all_books;
    }
    

    
    public function addIsbn($isbn, $title, $category, $author, $description)
    {
        // clean the input to prevent for example javascript within the notes.
        $isbn = strip_tags($isbn);
        $title = strip_tags($title);
        $category = strip_tags($category);
        $author = strip_tags($author);
        $description = strip_tags($description);

        $sql = "INSERT INTO book (isbn, title, category, author, description) 
                VALUES (:isbn, :title, :category, :author, :description)";
        $query = $this->db->prepare($sql);
        $query->execute(array(  ':isbn' => $isbn, 
                                ':title' => $title,
                                ':category' => $category,
                                ':author' => $author,
                                ':description' => $description
                                ));
        $count =  $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_ADD_SUCCESSFUL;
        return true;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }
    
    public function onLoan() // get all books currently on loan
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.publicationYear,
        b.onLoan,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        WHERE onLoan = '1' ORDER BY id DESC");
        $sth->execute();

        $all_books = array();

        foreach ($sth->fetchAll() as $book) {
            // a new object for every user. This is eventually not really optimal when it comes
            // to performance, but it fits the view style better
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->author = $book->author;
            $all_books[$book->id]->category = $book->cat_name;
            $all_books[$book->id]->isbn = $book->isbn;
        }
        return $all_books;
    }
    
    public function availableBooks() // get all books currently on loan
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.publicationYear,
        b.onLoan,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        WHERE available = '1' ORDER BY id DESC");
        $sth->execute();

        $all_books = array();

        foreach ($sth->fetchAll() as $book) {
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->author = $book->author;
            $all_books[$book->id]->category = $book->cat_name;
            $all_books[$book->id]->isbn = $book->isbn;
        }
        return $all_books;
    }


}
