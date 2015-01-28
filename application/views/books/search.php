
<div class="content">
    <h1>Search</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    
<div class="container">
    <div class="names"> 
        <div class="demo typeahead-demo">
            
            <form id="search" name="search" action="<?php echo URL; ?>books/itemView?id=" method="post">
            <input type="text" name="search" class="typeahead" placeholder="type here to search..." id="demo"/>
            <input type="text" name="id" class="typeahead" id="id" style="display:none"/>
            <input type="text" name="search" class="typeahead" id="isbn" style="display:none"/>
            <input type="submit" value="Submit" style="">
            </form> 
            
        </div>
    </div>
</div>
</div>


<script>
$(document).ready(function(){
$('#search').on('submit', function() {
    
    var isbn = $('#isbn').val();//get val from isbn field
    
    var newIsbn = isbn.replace(/-/g, "");
    
    var id = $('#id').val();//get val from user selection (id)
    var both = id+'&isbn='+newIsbn; //add both vals above
    
    var formAction = $('#search').attr('action'); //set the var formAction
    $('#search').attr('action', formAction + both); //change this formAction depending on both id & isbn
});

//
    $('#search').validate({
        rules: {
            search: {
                minlength: 3,
                required: true
            }
        },

        errorElement: 'span',
        errorClass: 'help-block'
    });
//


});//end dom ready
</script>