
<div class="container">
    
    
<div class="row">

<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>
<span class="label label-danger">TESTING ONLY</span>
<hr>


</div>    
    
    
</div>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Home
                </h1>
                <p>Welcome to our online library.</p>

                <p>
                    We have a number of books available, please search, browse and contact us 
                    if you have any questions. You can request to borrow a book, this will be 
                    held for you for one working day, after this it will be released again.
                </p>
                <p>
                    If you cannot find a book, or would like to suggest a book please let us know.
                </p>
                <hr>
                
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> LittleHands SureStart News</h4>
                    </div>
<div class="panel-body text-center">
    <?php
    $opts = array(
    'http' => array(
        'user_agent' => 'PHP libxml agent',
    )
    );

    $context = stream_context_create($opts);
    libxml_set_streams_context($context);
    $rss = new DOMDocument();
    $rss->load('http://www.littlehandssurestart.co.uk/blog?format=feed&type=rss');
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
    $item = array ( 
     'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
     'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
     );
    array_push($feed, $item);
    } 
    $limit = 3;
    for($x=0;$x<$limit;$x++) {
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $link = $feed[$x]['link'];
    echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
    }  
    ?>
    </br>
    <a href="#" class="btn btn-default">Visit Website</a>
</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> BBC Education News</h4>
                    </div>
<div class="panel-body text-center">
    <?php
    $rss = new DOMDocument();
    $rss->load('http://feeds.bbci.co.uk/news/education/rss.xml?edition=uk');

    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
    $item = array ( 
     'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
     'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
     );
    array_push($feed, $item);
    } 
    $limit = 3;
    for($x=0;$x<$limit;$x++) {
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $link = $feed[$x]['link'];
    echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
    }  
    ?>
    </br>
    <a href="#" class="btn btn-default">Visit Website</a>
</div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Popular Books</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Book of the week</h2>
            </div>
            <div class="col-md-6">
                <h2>
                <?php 
                    foreach ($this->bookOfWeek as $bookOfWeek) {
                        echo '<p><a href="'.URL.'books/itemView?id='.$bookOfWeek->id.'&isbn='.str_replace ('-', '', $bookOfWeek->isbn) .'">'.$bookOfWeek->title.'</a></br>';                      
                    }
                 ?> 
                </h2>
                <p>
                    
                <?php 
                
                    $isbn = str_replace ('-', '', $bookOfWeek->isbn); //get isbn from url  
                    $str = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn"); 
                    $data = json_decode($str, true);//$str is your json string    
                    
                    if(isset($data['items'][0]['volumeInfo']['description']) && $data['items'][0]['volumeInfo']['description']!='')  { 
                        echo $data['items'][0]['volumeInfo']['description'] ?: 'not available';
                        }else{
                            echo $bookOfWeek->description ?: 'description not available';  
                        }
                    
                    //foreach ($this->bookOfWeek as $bookOfWeek) {
                        //echo $bookOfWeek->description;  
                    //}
                 ?>
                
                </p>
            </div>
            <div class="col-md-6 text-center">
                <?php 
                
                if(isset($data['items'][0]['volumeInfo']['imageLinks']['thumbnail']) && $data['items'][0]['volumeInfo']['imageLinks']['thumbnail']!='')  { 
                    echo '<img src="'.$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'].'" alt="Cover">';
                    
                    //$data['items'][0]['volumeInfo']['imageLinks']['thumbnail'] ?: 'not available';
                    }else{
                        echo "<img src='../application/views/images/icons/no_img_avail.jpg' >";
                        } 
                        
                ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>If you have any questions or queries you can contact us here.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-info btn-block" href="#">Contact</a>
                </div>
            </div>
        </div>

        <hr>

    </div>
    <!-- /.container -->


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>