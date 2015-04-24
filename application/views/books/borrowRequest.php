<script>
function goBack() {
    window.history.back()
}
</script>

<div class="container">
    
        <div class="row">
    
    <h1>Borrow Request</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>Please confirm your request.</p> 
    <div class="alert alert-warning" role="alert">
        
    This will be reserved for you to collect until then end of 
        <?php 
        $date = new DateTime('today');
        $date->modify('1 weekday');
        echo $date->format('d-M-Y'); // 2014-01-04
        ?>    
        
    </div>
    
    </p>

    <p>

    <table class="overview-table">
            
    <?php

    foreach ($this->books as $book) {

        echo "<tr>";
        echo '<tr>';
        echo '<td>ID</td>';
        echo '<td>'.$book->id.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Title</td>';
        echo '<td>'.$book->title.'</td>';
        echo '</tr>';           

        echo "<tr>";
        echo '<tr>';
        echo '<td></td>';
        echo '<td>'.$book->thumbnail.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td></td>';
        echo '<td>
            
            <form action="'.URL.'books/borrowRequestAction?id='.$book->id.'" method="post">
            <label></label>
            <input type="submit" class="btn btn-info" name="borrow_request" value="Request" />
            </form>
            
            </td>';
        echo '</tr>';

    }

    ?>
    </table>
    </p>
    <a class="btn btn-xs btn-warning" href="#" onclick="goBack();">cancel</a>
    </div>
    
</div>
