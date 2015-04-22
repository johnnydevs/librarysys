<div class="container">
    
    <div class="row">
    
    <h1>Archive</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <h3>Deleted books (bin)</h3>
    Showing <?php echo count($this->books); ?>
    <p>
    <table class="table table-hover">

        <?php
        foreach ($this->books as $book) {
            
            echo "<tr>";
            echo '<td>'.$book->id.'</td>';
            echo '<td>'.$book->title.'</td>';
            echo '<td>'.$book->author.'</td>';
            echo '<td>'.$book->category.'</td>';
            echo '<td>'.$book->isbn.'</td>';
            echo "</tr>";
        }
        ?>
    </table>
    
    </div>

</div>