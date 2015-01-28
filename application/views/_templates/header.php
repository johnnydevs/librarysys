<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Application</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/reset.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/typeahead.css" />
    
    <!-- bootstrap validator -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrapValidator.css" />
    
    <!-- in case you wonder: That's the cool-kids-protocol-free way to load jQuery -->
    <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
        <!-- bootstrap validator js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
   
    <script type="text/javascript" src="<?php echo URL; ?>public/js/application.js"></script>

    <!-- testing typeahead script files -->
    <script src="<?php echo URL; ?>public/js/typeahead.bundle.js"></script>
    <script src="<?php echo URL; ?>public/js/handlebars-v1.3.0.js"></script>
    <script src="<?php echo URL; ?>public/js/examples.js"></script>
    
    
    <script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    });    
    </script>   
    
</head>
<body>

    <div class="debug-helper-box">
        DEBUG HELPER: you are in the view: <?php echo $filename; ?>
    </div>

    <div class="title-box">

        <a href="<?php echo URL; ?>"><img id="12" border="0" src="<?php echo URL; ?><?php echo LOGO; ?>" alt="Image" /></a>
        
    </div>
 
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Library App</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                
                <!-- for not logged in users -->
                <?php if (Session::get('user_logged_in') == false):?>
                <li <?php if ($this->checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo URL; ?>login/index">Login</a>
                </li>
                <li <?php if ($this->checkForActiveControllerAndAction($filename, "login/register")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo URL; ?>login/register">Register</a>
                </li>
                <?php endif; ?>
                
                <li <?php if ($this->checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                <a href="<?php echo URL; ?>index/index">Index</a>
                </li>
                
                <li <?php if ($this->checkForActiveController($filename, "help")) { echo ' class="active" '; } ?> class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Help <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li <?php if ($this->checkForActiveController($filename, "help")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>help/faq">FAQ</a>
                </li>
                </ul>
                </li>
                
                <?php if (Session::get('user_logged_in') == true):?>
                <li <?php if ($this->checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                <a href="<?php echo URL; ?>dashboard/index">Dashboard</a>
                </li>
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Books <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li <?php if ($this->checkForActiveController($filename, "books")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>books/index">List</a>
                </li>    
                <li <?php if ($this->checkForActiveController($filename, "books")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>books/search">Search</a>
                </li>
                
                </ul>
                </li>
                   
                <li <?php if ($this->checkForActiveController($filename, "notes")) { echo ' class="active" '; } ?> >
                <a href="<?php echo URL; ?>note/index">Notes</a>
                </li>
                <?php endif; ?> 
              
                <?php if (Session::get('user_logged_in') == true):?>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/showprofile">Profile</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/changeaccounttype">Change Type</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/uploadavatar">Upload Avatar</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/editusername">Edit Username</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/edituseremail">Edit Email</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/logout">Logout</a>
                </li>
                </ul>
                </li>
                <?php endif; ?> 
                
                <!-- for not admin users -->    
                <?php if (Session::get('user_account_type') == 2):?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/index">Dashboard</a>
                </li>    
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/addBook">Add Book</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/archive">Archive</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/users">Users</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/searchIsbn">Search Isbn</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>admin/bin">Bin</a>
                </li>
                <li <?php if ($this->checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/logout">Logout</a>
                </li>
                
                </ul>
                </li>
                <?php endif; ?>
              
              
            </ul>
              <?php if (Session::get('user_logged_in') == true):?>
            <ul class="nav navbar-nav navbar-right">
              <li><a data-toggle="tooltip" data-placement="bottom" title="favourites" id="favourites" href="<?php echo URL; ?>books/favouriteList"><span class="glyphicon glyphicon-star"></span> <span class="badge"></span></a></li>            
              <?php endif; ?> 
              <li><?php if (USE_GRAVATAR) { ?>
                        <img src='<?php echo Session::get('user_gravatar_image_url'); ?>'
                             style='width:<?php echo AVATAR_SIZE; ?>px; height:<?php echo AVATAR_SIZE; ?>px;' />
                    <?php } else { ?>
                        <img src='<?php echo Session::get('user_avatar_file'); ?>'
                             style='width:<?php echo AVATAR_SIZE; ?>px; height:<?php echo AVATAR_SIZE; ?>px;' />
                    <?php } ?> </li>
              
              <li><a href="<?php echo URL; ?>login/showprofile">Hello <?php echo Session::get('user_name'); ?> !</a></li>
            </ul>
              
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
