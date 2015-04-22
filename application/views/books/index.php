<div class="container">
    
    <div class="row">
    
    <h1>Books</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <h3>List of all books</h3>
    
<table class="table table-hover">
<?php

    foreach ($this->books as $book) {

        echo '<tr>';
        echo '<td>'.$book->id.'</td>';
        echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'">'.$book->title.'</a></td>';
        echo '<td>'.$book->author.'</td>';
        echo '<td>'.$book->category.'</td>';
        echo '<td>'.$book->isbn.'</td>';
        if($book->available==0){
            echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'"><span class="label label-default">unavailable</span></a></td>';
                }elseif($book->available==1){
                    echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'"><span class="label label-success">available</span></a></td>';   
                        }
                        else{
                            echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'"><span class="label label-warning">on loan</span></a></td>';   
                                }
        echo "</tr>";

    }

?>
</table>
    
    </div>

</div>