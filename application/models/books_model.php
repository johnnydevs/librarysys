<?php

/**
 * OverviewModels
 * Handles data for overviews (pages that show user profiles / lists)
 */
class BooksModel
{
    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Gets an array that contains all the users in the database. The array's keys are the user ids.
     * Each array element is an object, containing a specific user's data.
     * @return array The profiles of all users
     */
    public function getAllBooks()
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title,
        b.category, 
        b.author, 
        b.isbn, 
        b.available,
        b.onLoan,
        b.bin,
        b.publicationYear,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        WHERE archive != '1' AND bin != '1' ORDER BY id DESC LIMIT 30");
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
            $all_books[$book->id]->available = $book->available;
            $all_books[$book->id]->onLoan = $book->onLoan;
        }
        return $all_books;
    }
    
        public function itemView()
    {
        $isbn=$_GET['isbn']; //get isbn from url  
        //$id=$_GET['id']; //get isbn from url 
        $str = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn"); 
        $data = json_decode($str, true);//$str is your json string   // 
        
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.publicationYear,
        b.description,
        b.archive,
        b.available,
        b.bookOfWeek,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        LEFT JOIN category AS c ON b.category = c.id
        WHERE b.id ='" . ($_GET['id']) . "'");
        $sth->execute();
        
        $sqlupdate = $this->db->prepare("UPDATE book SET views = views+1 WHERE id ='" . ($_GET['id']) . "'");
        $sqlupdate->execute();

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
            $all_books[$book->id]->available = $book->available;
            $all_books[$book->id]->archive = $book->archive;
            $all_books[$book->id]->bookOfWeek = $book->bookOfWeek;
            
            if(isset($data['items'][0]['volumeInfo']['publishedDate']) && $data['items'][0]['volumeInfo']['publishedDate']!='')  { 
            $all_books[$book->id]->publicationYear = $data['items'][0]['volumeInfo']['publishedDate'] ?: 'not available';
            }else{
                $all_books[$book->id]->publicationYear = $book->publicationYear ?: 'not available';
            }
            
            if(isset($data['items'][0]['volumeInfo']['description']) && $data['items'][0]['volumeInfo']['description']!='')  { 
            $all_books[$book->id]->description = $data['items'][0]['volumeInfo']['description'] ?: 'not available';
            }else{
                $all_books[$book->id]->description = $book->description ?: 'not available';
            }
            
            if(isset($data['items'][0]['volumeInfo']['imageLinks']['thumbnail']) && $data['items'][0]['volumeInfo']['imageLinks']['thumbnail']!='')  { 
            $all_books[$book->id]->thumbnail = '<img src="'.$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'].'" alt="Cover">';
                    
                    //$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'] ?: 'not available';
            }else{
                $all_books[$book->id]->thumbnail = "<img src='../application/views/images/icons/no_img_avail.jpg' >";
            }

        }
        return $all_books;
    }
    
    public function categoryView()
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
        WHERE archive != '1' AND category = :cat OR cat_name = :cat ORDER BY id DESC LIMIT 15");
        
        $sth->bindValue(':cat', $_GET['category']);
        $sth->execute();
        
        //$result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //return count($result);
        
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
    
    public function borrowRequestView()
    {
        $isbn=$_GET['isbn']; //get isbn from url  
        $str = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn"); 
        $data = json_decode($str, true);//$str is your json string   // 
        
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
        WHERE archive != '1' AND b.id = :id ORDER BY id DESC LIMIT 15");
        
        $sth->bindValue(':id', $_GET['id']);
        $sth->execute();
        
        //$result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //return count($result);
        
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
            
            if(isset($data['items'][0]['volumeInfo']['publishedDate']) && $data['items'][0]['volumeInfo']['publishedDate']!='')  { 
            $all_books[$book->id]->publicationYear = $data['items'][0]['volumeInfo']['publishedDate'] ?: 'not available';
            }else{
                $all_books[$book->id]->publicationYear = $book->publicationYear ?: 'not available';
            }
            
            if(isset($data['items'][0]['volumeInfo']['description']) && $data['items'][0]['volumeInfo']['description']!='')  { 
            $all_books[$book->id]->description = $data['items'][0]['volumeInfo']['description'] ?: 'not available';
            }else{
                $all_books[$book->id]->description = $book->description ?: 'not available';
            }
            
            if(isset($data['items'][0]['volumeInfo']['imageLinks']['thumbnail']) && $data['items'][0]['volumeInfo']['imageLinks']['thumbnail']!='')  { 
            $all_books[$book->id]->thumbnail = '<img src="'.$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'].'" alt="Cover">';
                    
                    //$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'] ?: 'not available';
            }else{
                $all_books[$book->id]->thumbnail = "<img src='../application/views/images/icons/no_img_avail.jpg' >";
            }
            
        }
        return $all_books;
        
    }
    
    public function borrowRequest()
    {

        $book_id = $_GET['id']; //GET BOOK ID FROM URL
        $date_request = date("Y-m-d H:i:s");
        $date1 = str_replace('-', '/', $date);
        $date_expire = date("Y-m-d H:i:s",strtotime($date1 . "+1 days"));
        
        // write new users data into database
        $sql = "INSERT INTO borrow_request (borrow_id, user_id, book_id, date_request, date_expire)
                VALUES (:borrow_id, :user_id, :book_id, :date_request, :date_expire)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':borrow_id' => 'DEFAULT',
                              ':user_id' => $_SESSION['user_id'],
                              ':book_id' => $book_id,
                              ':date_request' => $date_request,
                              ':date_expire' => $date_expire));
        
        //update the books table
        $sqlupdate = "UPDATE book SET available = :available WHERE id = :id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->execute(array(':available' => '0',
                                    ':id' => $book_id
                                    ));
        
        if ($query->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_RESERVE_SUCCESSFUL;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_RESERVE_UNSUCCESSFUL;
            }
        
        header('location: ' . URL . 'books/index');
    }
    
    public function markAvailable()
    {
        $book_id = $_REQUEST['id'];
        $sqlupdate = "UPDATE book SET available = :available WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->execute(array(':available' => '1',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_SET_AVAILABLE_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_SET_AVAILABLE_FAIL;
            } 
    }    
    
    public function markUnavailable()
    {
        $book_id = $_REQUEST['id'];
        $sqlupdate = "UPDATE book SET available = :available WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->execute(array(':available' => '0',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_SET_UNAVAILABLE_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_SET_UNAVAILABLE_FAIL;
            }
    }
    
    public function archiveBook()
    {
        $book_id = $_REQUEST['id'];
        $sqlupdate = "UPDATE book SET archive = :archive WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->execute(array(':archive' => '1',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_ARCHIVE_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_ARCHIVE_FAIL;
            }  
    }
    
    public function deleteBook()
    {
        $book_id = $_REQUEST['id'];
        $sqlupdate = "UPDATE book SET bin = :bin WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->execute(array(':bin' => '1',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_BIN_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_BIN_FAIL;
            }  
    }
    
    
    public function checkFav($bookid,$userid)
    {
    $bookid=$_REQUEST['book_id']; //get this from ajax
    $userid=$_SESSION['user_id']; //get this from session
    $sql = "SELECT * FROM favourite WHERE book_id = :book_id AND user_id = :user_id"; //use named placeholders i.e PDO not mysqli
    $query = $this->db->prepare($sql);
    $query->bindParam(':user_id', $userid);
    $query->bindParam(':book_id', $bookid);
    $query->execute();
    $rows_found = $query->fetchColumn();//numRows doesnt work
    
         if(empty($rows_found)) {
            $isFav = '1'; 
            $sql = "INSERT INTO favourite (book_id, user_id, isFav) VALUES (:book_id, :user_id, :isFav)";
            $query = $this->db->prepare($sql);
            $query->bindParam(':user_id', $userid);
            $query->bindParam(':book_id', $bookid);
            $query->bindParam(':isFav', $isFav);
            $query->execute();

            if ($query->rowCount() == 1) {
                // successful add to favs
                $_SESSION["feedback_positive"][] = FEEDBACK_ADDED_TO_FAVS;
                $_SESSION['btnClicked'] = 'success';
                return true;
            }

        } else { 
            $sql = "DELETE FROM favourite WHERE book_id = :book_id AND user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':user_id', $userid);
            $query->bindParam(':book_id', $bookid);
            $query->execute();

            if ($query->rowCount() > 0) {
                // successful remove from favs
                $_SESSION["feedback_negative"][] = FEEDBACK_REMOVED_FROM_FAVS;
                //unset($_SESSION['btnClicked']);
                $_SESSION['btnClicked'] = 'remove';
                return true;
                }        
        }
    }
    
    public function search()//typeahead search
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.category, 
        b.author, 
        b.isbn, 
        b.description, 
        b.available, 
        b.publicationYear,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        ");
        $sth->execute();

        $all_books = array();
        foreach ($sth->fetchAll() as $book) {
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->author = $book->author;
            $all_books[$book->id]->category = $book->cat_name;
            $all_books[$book->id]->isbn = $book->isbn;
            $all_books[$book->id]->description = $book->description;
            $all_books[$book->id]->available = $book->available;

        }
        
        $fp = fopen('books.json', 'w');
        fwrite($fp, json_encode($all_books));
        
        return $all_books;
    }
    
    public function favList()
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.author, 
        b.isbn
        FROM book AS b
        LEFT JOIN favourite AS c ON b.id = c.book_id
        WHERE user_id = :user_id
        AND isFav = 1
        LIMIT 0 , 30
        ");
        
        $sth->bindValue(':user_id', $_SESSION['user_id']);
        $sth->execute();
        
        $all_books = array();
        
        foreach ($sth->fetchAll() as $book) {
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->isbn = $book->isbn;
        }
        return $all_books;
        
    }
    
    public function resList()
    {
        $sth = $this->db->prepare("SELECT 
        b.id, 
        b.title, 
        b.author, 
        b.isbn
        FROM book AS b
        LEFT JOIN borrow_request AS c ON b.id = c.book_id
        WHERE user_id = :user_id
        AND isExpired = 0
        LIMIT 0 , 30
        ");
        
        $sth->bindValue(':user_id', $_SESSION['user_id']);
        $sth->execute();
        
        $all_books = array();
        
        foreach ($sth->fetchAll() as $book) {
            
            $all_books[$book->id] = new stdClass();
            $all_books[$book->id]->id = $book->id;
            $all_books[$book->id]->title = $book->title;
            $all_books[$book->id]->isbn = $book->isbn;
        }
        return $all_books;
        
    }
    
    public function deleteFav()
    {
        $book_id = $_REQUEST['book_id'];
        $isFav = $_REQUEST['isFav'];
        $user_id=$_SESSION['user_id']; //get this from session
        $sqlupdate = "UPDATE favourite SET isFav = :isFav WHERE book_id = :book_id AND user_id = :user_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->bindParam(':book_id', $book_id);
        $queryupdate->bindParam(':isFav', $isFav);
        $queryupdate->bindParam(':user_id', $user_id);
        $queryupdate->execute();
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_REMOVED_FROM_FAVS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_REMOVED_FROM_FAVS_FAIL;
            }
    }
    
    public function deleteRes()
    {
        $book_id = $_REQUEST['book_id'];
        $isExpired = '1';
        $user_id=$_SESSION['user_id']; //get this from session
        $sqlupdate = "UPDATE borrow_request SET isExpired = :isExpired WHERE book_id = :book_id AND user_id = :user_id";
        $queryupdate = $this->db->prepare($sqlupdate);
        $queryupdate->bindParam(':book_id', $book_id);
        $queryupdate->bindParam(':isExpired', $isExpired);
        $queryupdate->bindParam(':user_id', $user_id);
        $queryupdate->execute();
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_REMOVED_FROM_RESERVATIONS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_REMOVED_FROM_RESERVATIONS_FAIL;
            }
    }
    
    public function randomBooks()
    {
  
        $sql = "SELECT 
        b.id, 
        b.title,
        b.isbn,
        b.category,
        b.available,
        case 
         when cast(b.category as unsigned)= 0 then b.category
         else c.cat_name 
        end as cat_name 
        FROM book AS b
        left JOIN category AS c ON b.category = c.id
        ORDER BY RAND() DESC LIMIT 10";
        
        $query = $this->db->prepare($sql);
        $query->execute(array());
        
        $all_books = array();
        
        foreach ($query->fetchAll() as $similarBook) {
            
            $all_books[$similarBook->id] = new stdClass();
            $all_books[$similarBook->id]->id = $similarBook->id;
            $all_books[$similarBook->id]->title = $similarBook->title;
            $all_books[$similarBook->id]->isbn = $similarBook->isbn;
            $all_books[$similarBook->id]->cat_name = $similarBook->cat_name;
            $all_books[$similarBook->id]->available = $similarBook->available;
        }
        return $all_books;
    }
    
    public function markBookOfWeek()
    {
        $book_id = $_REQUEST['id'];
        $sql = "UPDATE book SET bookOfWeek = :bookOfWeek WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sql);
        $queryupdate->execute(array(':bookOfWeek' => '1',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_SET_BOOKOFWEEK_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_SET_BOOKOFWEEK_FAIL;
            } 
    }
    
    public function removeBookOfWeek()
    {
        $book_id = $_REQUEST['id'];
        $sql = "UPDATE book SET bookOfWeek = :bookOfWeek WHERE id = :book_id";
        $queryupdate = $this->db->prepare($sql);
        $queryupdate->execute(array(':bookOfWeek' => '0',
                                    ':book_id' => $book_id
                                    ));
        
        if ($queryupdate->rowCount() == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_BOOK_SET_BOOKOFWEEK_SUCCESS;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_BOOK_SET_BOOKOFWEEK_FAIL;
            } 
    }
    
    public function getBookOfWeek()
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
        WHERE bookOfWeek = '1'");

        $sth->execute();
        
        //$result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //return count($result);
        
        $all_books = array();
        
        foreach ($sth->fetchAll() as $bookOfWeek) {
            
            $all_books[$bookOfWeek->id] = new stdClass();
            $all_books[$bookOfWeek->id]->id = $bookOfWeek->id;
            $all_books[$bookOfWeek->id]->title = $bookOfWeek->title;
            $all_books[$bookOfWeek->id]->author = $bookOfWeek->author;
            $all_books[$bookOfWeek->id]->category = $bookOfWeek->cat_name;
            $all_books[$bookOfWeek->id]->isbn = $bookOfWeek->isbn;
        }
        return $all_books;
        
    }
    
    public function getPopular()
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
        order by views desc limit 2");

        $sth->execute();
        
        $all_books = array();
        
        foreach ($sth->fetchAll() as $popularBook) {
            
            $all_books[$popularBook->id] = new stdClass();
            $all_books[$popularBook->id]->id = $popularBook->id;
            $all_books[$popularBook->id]->title = $popularBook->title;
            $all_books[$popularBook->id]->author = $popularBook->author;
            $all_books[$popularBook->id]->category = $popularBook->cat_name;
            $all_books[$popularBook->id]->isbn = $popularBook->isbn;
        }
        return $all_books;
        
    }
    
    public function isFav()
        {
            $book_id = $_GET['id']; // from url
            $user_id=$_SESSION['user_id'];
            $sql = "SELECT isFav FROM favourite WHERE book_id = :book_id AND user_id = :user_id AND isFav = 1";
            $query = $this->db->prepare($sql);
            $query->bindParam(':book_id', $book_id);
            $query->bindParam(':user_id', $user_id);
            $query->execute();

            if ($query->rowCount() == 1) {
                    $css = 'btn-success';
                } else {
                    $css = 'btn-default';
                }
                return $css;
        }
    
 
}

