<div class="content">
    <h1>Borrow Request</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>
        Please confirm your request. This will be held for 24hours. Expires: 
            <?php 
            $date = new DateTime('today');
            $date->modify('1 weekday');
            echo $date->format('Y-m-d H-i'); // 2014-01-04
            ?>
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
        echo '<td>Image</td>';
        echo '<td>'.$book->thumbnail.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Request</td>';
        echo '<td>
            
            <form action="'.URL.'books/borrowRequestAction?id='.$book->id.'" method="post">
            <label></label>
            <input type="submit" name="borrow_request" value="Request" />
            </form>
            
            </td>';
        echo '</tr>';

    }

    ?>
    </table>
    </p>
</div>
