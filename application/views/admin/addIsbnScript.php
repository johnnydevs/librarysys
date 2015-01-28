
<?php



$title = $_POST['title'];
$isbn = strip_tags($isbn);
$category = strip_tags($category);

$sql = "INSERT INTO book (title, isbn, category) 
        VALUES (:title, :isbn, :category)";
$query = $this->db->prepare($sql);
$query->execute(array(  ':title' => $title, 
                        ':isbn' => $isbn,
                        ':category' => $category
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






?>
