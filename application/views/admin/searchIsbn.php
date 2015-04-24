<div class="container">
    
    <div class="row">
    
    <h1>Search ISBN</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>  
    <div id="result2"></div>
    <form id="form" method="post" action="">
        <input type="text" class="typeahead tt-input" id="isbn_search" name="isbn_search" placeholder="enter an isbn here" />
        
        <input type="submit" class="btn btn-info" value='Search Google Books' />
    </form>
    
    <hr>

    <div id="result"></div>
    
    </div>
    
</div>

<script>
    function myFunction() {
    location.reload();
    }
    var addID = 1;//add button start at 1
    $( '#form' ).submit(function() {
        var isbn = $('#isbn_search').val(); //get isbn direct from input, no need for php
        isbn = isbn.replace(/-/g, '');//remove any dashes or spaces input by user
        var url='https://www.googleapis.com/books/v1/volumes?q=isbn:'+isbn;
        event.preventDefault();
        $.getJSON(url,function(data){
            
            $.each(data.items, function(entryIndex, entry){  
                $('#result').html(''); //reset result div content
                $('#result2').html(''); //reset result div content
                var html = '<div class="result">';  
                addID++;//increment add to lib button
                html += '<h3>' + ( entry.volumeInfo.title || 'not available' )+ '</h3>';  
                html += '<p><img src=' + ( entry.volumeInfo.imageLinks.thumbnail ) + '</p>';
                html += '<p>Description: ' + ( entry.volumeInfo.description || 'not available' )+ '</p>';
                html += '<p>Category: ' + ( entry.volumeInfo.categories || 'not available' )+ '</p>';
                html += '<p>Author: ' + ( entry.volumeInfo.authors || 'not available' )+ '</p>';   
                html += '<hr><input class="btn btn-success" type="button" id="add'+addID+'" value="Add book to library" name="add"/> | ';
                html += '<input class="btn btn-default" type="cancel" value="Search again" onclick="myFunction()" name="cancel"/></div>';
                $(html).hide().appendTo('#result').fadeIn(1000);
                
                $('#add'+addID).click(function(ev) {
                    var html2 = '<div class="result2 feedback success">';
                     html2 += '<p>Successfully added: ' + ( entry.volumeInfo.title || 'not available' )+ '</p></div>'; 
                        $.ajax({
                         type: 'POST',
                         url: '<?php echo URL; ?>admin/addIsbn',
                         data: {
                             'isbn' : isbn,
                             'title' : entry.volumeInfo.title,
                             'category' : (entry.volumeInfo.categories ? entry.volumeInfo.categories[0] : 'not available') ,
                             'author' : (entry.volumeInfo.authors ? entry.volumeInfo.authors[0] : 'not available'),
                             'description' : entry.volumeInfo.description ||'not available'
                         },
                         success: function () { //when form has been submitted successfully do below 
                             $('.result').fadeOut(1000); //fade out the results div
                             $('#form')[0].reset();
                             $(html2).hide().appendTo('#result2').fadeIn(1000);
                             //window.location.reload(true);//reload the page once form has been submitted
                            }//end success        
                    });//end ajax
                });//end add button funct 
            });
        });//end getJSON  
 });
    
</script>    