<?php

//$css = "btn-default";

//if(isset($_SESSION['btnClicked']) && $_SESSION['btnClicked'] == 'success') { $css = "btn-success"; }

//if(isset($_SESSION['btnClicked']) && $_SESSION['btnClicked'] == 'remove') { $css = "btn-default"; }


function getDropMenuForAvailable(){
return <<<HTML
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Available <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="/books/borrowRequest?id=3118">Borrow Request</a></li>
  </ul>
</div>
HTML;
};

function getDropMenuForOnLoan(){
return <<<HTML
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    On Loan <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="/books/borrowRequest?id=3118">Availability Alert</a></li>
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
<style>
.btn-group, .btn-group-vertical {
margin-bottom: 20px; /*space at bottom of admin btn group*/
}    
</style>
<script>
    
function goBack() {
    window.history.back()
}
    
$(document).ready(function(){
    $( "#fav" ).click(function(){    
    book_id = $(fav).val(); 
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/checkFav',
         data: {
             book_id:book_id
             },
         success: function () { 
             window.location.reload(true);
            }//end success        
        });//end ajax   
    });
    
       //testing
    $( "#mark_as_available" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/markAvailable',
         data: {
             'id' : id
             },
         success: function () { 
             window.location.reload(true);
            }//end success        
        });//end ajax   
    });
    
    $( "#mark_as_unavailable" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/markUnavailable',
         data: {
             'id' : id
             },
         success: function () { 
             window.location.reload(true);
            }//end success        
        });//end ajax   
    });
    
    $( "#archive_book" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/archiveBook',
         data: {
             'id' : id
             },
         success: function () { 
            alert('successfully archived');
            window.location = '<?php echo URL; ?>books/index';
            }//end success        
        });//end ajax   
    });
    
     $( "#addBookOfWeek" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/markBookOfWeek',
         data: {
             'id' : id
             },
         success: function () { 
            alert('successfully marked as book of the week');
            window.location = '<?php echo URL; ?>books/index';
            }//end success        
        });//end ajax   
    });
    
    $( "#removeBookOfWeek" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/removeBookOfWeek',
         data: {
             'id' : id
             },
         success: function () { 
            alert('successfully removed as book of the week');
            window.location = '<?php echo URL; ?>books/index';
            }//end success        
        });//end ajax   
    });
    
    $( "#delete_book" ).click(function(){    
    var id = <?php echo $_GET['id']; ?>;
    //title = 'testTitle';
    $.ajax({
         type: 'POST',
         url: '<?php echo URL; ?>books/deleteBook',
         data: {
             'id' : id
             },
         success: function () { 
            alert('successfully deleted');
            window.location = '<?php echo URL; ?>books/index';
            }//end success        
        });//end ajax   
    });
    
    //testing
    
    
});
</script>

<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-9">

     <h1>Item View</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <p>
        Book details
    </p>
    <p>
    <table class="table table-hover">
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
        echo '<td>Author</td>';
        echo '<td>'.$book->author.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Category</td>';
        echo '<td>'.$book->category.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>ISBN</td>';
        echo '<td>'.$book->isbn.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Year</td>';
        echo '<td>'.$book->publicationYear.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Description</td>';
        echo '<td>'.$book->description.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Image</td>';
        echo '<td>'.$book->thumbnail.'</td>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Link</td>';
        echo '<td><a href="http://www.google.co.uk/search?q='.$book->title.'&btnG=Search+Books&tbm=bks&tbo=1&gws_rd=ssl" target="_blank">View on Google Books</td></a>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Availability</td>';
            
            if($book->available==0)  {
            echo '<td>'.getDropMenuForUnavailable().'</td>';     
            }
        
            elseif($book->available==1)  {
            echo '<td>
                <a class="btn btn-success" href="'.URL.'books/borrowRequest?id='.$book->id.'&isbn='.str_replace ('-', '', $book->isbn) .'">Borrow Request
            </td></a>';
            }elseif($book->available==2)  {
            echo '<td>'.getDropMenuForOnLoan().'</td>'; 
            }
        echo '</tr>'; 
        echo "</tr>";
        
        echo "<tr>";
        echo '<tr>';
        echo '<td>Options</td>';
        echo '<td>
              <button id="fav" value="'.$book->id.'" type="button" class="btn '.$this->css.'"><span class="glyphicon glyphicon-star"></span></button>
              </td></a>';
        echo '</tr>';

        echo "<tr>";
        echo '<tr>';
        echo '<td>Similar</td>';
        echo '<td><a href="categoryView?category='.$book->category.'">View Similar Books</td></a>';
        echo '</tr>';  
    }
        
    ?>
        </table>
    
        <div class="btn-group" role="froup">   
        <a class="btn btn-xs btn-warning" href="#" onclick="goBack();">back</a>   
        </div>    
    
        <hr>
        
        
      <?php if (Session::get('user_account_type') == 2):?> <!-- for admin only -->

      <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
      Admin
    </button>
    <div class="collapse" id="collapseExample">
      <div class="panel panel-default">
      <div class="btn-group" role="group">
      <div class="panel-body">    

      <!--
      0 - unavailable
      1 - available
      2 - on loan
      -->
       
      <?php if($book->available==1):?>
      <button id="mark_as_available" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Loan</button>

      <?php elseif($book->available==2):?>
      <button id="mark_as_unavailable" type="button" class="btn btn-default"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> On Loan</button>
      
          
      <?php endif; ?> <!-- end if book available -->

      <?php if($book->archive=='0'):?>
      <button id="archive_book" type="button" class="btn btn-default"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Archive</button>
      <?php endif; ?> <!-- end if book archived -->

      <?php if($book->bookOfWeek=='0'):?>
      <button id="addBookOfWeek" type="button" class="btn btn-default"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Mark as Book Of Week</button>

      <?php elseif($book->bookOfWeek=='1'):?>
      <button id="removeBookOfWeek" type="button" class="btn btn-default"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Remove as Book Of Week</button>

      <?php endif; ?> 

      <button id="delete_book" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
      </div>
      </div>
    </div>
        
        

        </div>
    <?php endif; ?> <!-- end main if -->

</div>

            <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-3">

        <!-- Side Widget Well -->
        <div class="panel panel-info">
            <div class="panel-heading">Random Books</div>
                <div class="panel-body">
                    <?php 
                    foreach ($this->similarBooks as $similarBook) {
                        echo '
                        <p>   
                        <a href="'.URL.'books/itemView?id='.$similarBook->id.'&isbn='.str_replace ('-', '', $similarBook->isbn) .'">'.$similarBook->title.'</a>';
                        echo '<br>';
                        
                        echo '<span class="text-muted">'.$similarBook->cat_name.'</span>';  
                    }
                    ?>
                </div>  
        </div>

    </div>
            
            

</div>
        <!-- /.row -->


    </div>