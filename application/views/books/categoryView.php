<?php

function getDropMenuForAvailable(){
return <<<HTML
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Available <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Borrow Request</a></li>
    <li class="divider"></li>
    <li><a href="#">Similar Books</a></li>
  </ul>
</div>
HTML;
};

function getDropMenuForUnavailable(){
return <<<HTML
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Unavailable <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Availability Alert</a></li>
    <li class="divider"></li>
    <li><a href="#">Similar Books</a></li>
  </ul>
</div>
HTML;
};
?>

<div class="content">
    <h1>Category View</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        Similar books
    </p>

    <p>
        Showing <?php echo count($this->books); ?>
        <table class="table table-hover">

        <?php
        foreach ($this->books as $book) {
            echo "<tr>";
            echo '<td>'.$book->id.'</td>';
            echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'">'.$book->title.'</a></td>';
            echo '<td>'.$book->author.'</td>';
            echo '<td>'.$book->category.'</td>';
            echo '<td>'.$book->isbn.'</td>';
            echo "</tr>";
        }     
        ?> 
        </table>
    </p>

</div>
