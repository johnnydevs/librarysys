<div class="content">
    
    
    <?php   
    $title = $_GET['title'];
     ?>
    
    <h1><?php echo $title; ?></h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if (Session::get('user_account_type') == 2) { ?>
        
    <a href="<?php echo URL; ?>books/index">
    <input type="submit" value="return to books" />
    </a>
    
    <?php }  ?>
</div>