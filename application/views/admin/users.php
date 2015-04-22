<div class="container">
    
    <div class="row">
    
    <h1>Users</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <p>All registered users.</p>

    <p>
        <table class="table table-hover">
        <?php

        foreach ($this->users as $user) {

            if ($user->user_active == 0) {
                echo '<tr class="inactive">';
            } else {
                echo '<tr class="active">';
            }

            echo '<td>'.$user->user_id.'</td>';
            echo '<td class="avatar">';

            if (isset($user->user_avatar_link)) {
                echo '<img src="'.$user->user_avatar_link.'" />';
            }

            echo '</td>';
            echo '<td>'.$user->user_name.'</td>';
            echo '<td>'.$user->user_email.'</td>';
            echo '<td>Active: '.$user->user_active.'</td>';
            echo '<td><a href="'.URL.'admin/showuserprofile/'.$user->user_id.'">Show user\'s profile</a></td>';
            echo "</tr>";
        }

        ?>
        </table>
    </p>
    
    </div>
    
</div>
