<script>
$(document).ready(function(){
    $( ".fav" ).click(function(){    
    book_id = $(this).val(); 
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/deleteFav',
         data: {
             book_id:book_id
             },
         success: function () { 
             window.location.reload(true);
            }//end success        
        });//end ajax   
    });
   }); 
</script>   

<div class="container">
    
    <div class="row">

<h1>Favourites</h1>

<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>

<p>My favourites list</p>
    Showing <span class="label label-info label-as-badge"><?php echo count($this->books); ?></span>
    <hr>
    
    <table class="table table-hover">

    <?php
    foreach ($this->books as $favBook) {
        echo "<tr>";
        echo '<td>'.$favBook->id.'</td>';
        echo '<td><a href="'.URL.'books/itemView?id='.$favBook->id.'&isbn='.str_replace ('-', '', $favBook->isbn) .'">'.$favBook->title.'</a></td>';
        echo '<td>
              <button value="'.$favBook->id.'" type="button" class="btn btn-default fav"><span class="glyphicon glyphicon-trash"></span> remove</button>
              </td></a>';
        echo "</tr>";
    }     
    ?> 
    </table>  
    
    </div>

</div>