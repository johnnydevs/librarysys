<div class="content">
    <h1>Add Book</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <form method="post" action="<?php echo URL;?>admin/create">
        <label>Title: </label>
        <input type="text" name="title" />
        
        <label>Category: </label>
        <input type="text" name="category" />
        
        <label>Author: </label>
        <input type="text" name="author" />
        
        <label>ISBN: </label>
        <input type="text" name="isbn" />
        
        <label>Subtitle: </label>
        <input type="text" name="subtitle" />
        
        <label>Year: </label>
        <input type="text" name="publicationYear" />
        
        <label>Page Count: </label>
        <input type="text" name="pageCount" />
        
        <label>Description: </label>
        <input type="text" name="description" />
        
        <input type="submit" value='Add book to library' autocomplete="off" />
    </form>

    
</div>
