<style>

.box {
    border-radius: 3px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    padding: 10px 25px;
    text-align: right;
    display: block;
    margin-top: 60px;
}
.box-icon {
    background-color: #0097CA;
    border-radius: 50%;
    display: table;
    height: 100px;
    margin: 0 auto;
    width: 100px;
    margin-top: -61px;
}
.box-icon span {
    color: #fff;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.info h2 {
    font-size: 20px;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding-top: 10px;
}
.info > p {
    color: #717171;
    font-size: 16px;
    padding-top: 10px;
    text-align: center;
}
   
</style>
<div class="container">
    
    
<div class="row">
    
<h1>Home</h1>

<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>

<p>Welcome to out online library.</p>

<p>
    We have a number of books available, please search, browse and contact us 
    if you have any questions. You can request to borrow a book, this will be 
    held for you for one working day, after this it will be released again.
</p>
<hr>
<p>
    If you cannot find a book, or would like to suggest a book please let us know.
</p>
<hr>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="box">
            <div class="box-icon">
                <span class="fa fa-4x fa-calendar"></span>
            </div>
            <div class="info">
                <h2 class="text-center">Book of the week</h2>                
                 <?php 
                    foreach ($this->bookOfWeek as $bookOfWeek) {
                        echo '<p><a href="'.URL.'books/itemView?id='.$bookOfWeek->id.'&isbn='.str_replace ('-', '', $bookOfWeek->isbn) .'">'.$bookOfWeek->title.'</a></br>';                      
                    }
                 ?>      
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="box">
            <div class="box-icon">
                <span class="fa fa-4x fa-area-chart"></span>
            </div>
            <div class="info">
                <h2 class="text-center">Popular</h2>
                <?php 
                    foreach ($this->popularBook as $popularBook) {
                        echo '<p><a href="'.URL.'books/itemView?id='.$popularBook->id.'&isbn='.str_replace ('-', '', $popularBook->isbn) .'">'.$popularBook->title.'</a></br>';                      
                    }
                 ?> 
            </div>
        </div>
    </div>
</div>    
    
    
</div>
