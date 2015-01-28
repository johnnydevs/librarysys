<script>
$(document).ready(function(){
    $( "#fav" ).click(function(){    
    book_id = $(fav).val(); 
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

<div class="content">

<h1>Favourites</h1>

<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>

<p>My favourites list</p>
    Showing <?php echo count($this->books); ?>
    
    <table class="table table-hover">

    <?php
    foreach ($this->books as $book) {
        echo "<tr>";
        echo '<td>'.$book->id.'</td>';
        echo '<td><a href="'.URL.'books/itemView?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'">'.$book->title.'</a></td>';
        echo '<td>
              <button id="fav" value="'.$book->id.'" type="button" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> remove from favs</button>
              </td></a>';
        echo "</tr>";
    }     
    ?> 
    </table>    

</div>