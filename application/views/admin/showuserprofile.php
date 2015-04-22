<div class="container">
    
    <div class="row">
    
    <h1>Profile details</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if ($this->user) { ?>
        <p>
            <table class="overview-table">
            <?php

                if ($this->user->user_active == 0) {
                    echo '<tr class="inactive">';
                } else {
                    echo '<tr class="active">';
                }
                echo '<td>'.$this->user->user_id.'</td>';
                echo '<td class="avatar"><img src="'.$this->user->user_avatar_link.'" /></td>';
                echo '<td>'.$this->user->user_name.'</td>';
                echo '<td>'.$this->user->user_email.'</td>';
                echo '<td>Active: '.$this->user->user_active.'</td>';
                echo "</tr>";
            ?>
            </table>
        </p>
    <?php } ?>
        
    </div>
    
</div>

