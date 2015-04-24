<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SureStart Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo URL; ?>public/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/reset.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/custom.css" />
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
    <!--
    <div class="debug-helper-box">
        DEBUG HELPER: you are in the view: <?php echo $filename; ?>
    </div>
    -->

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
            <a class="navbar-brand" href="<?php echo URL; ?>index/index"><i class="fa fa-home"></i> Home</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                
                <!-- for not logged in users -->
                <?php if (Session::get('user_logged_in') == false):?>
                    <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/index">Login</a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>login/register">Register</a>
                    </li>
                <?php endif; ?>
                <!-- end for not logged in users -->
                
                <!-- for logged in users -->
                <?php if (Session::get('user_logged_in') == true):?>
                    

                    <li <?php if ($this->checkForActiveController($filename, "books")) { echo ' class="active" '; } ?> class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-book"></i> Books <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo URL; ?>books/index">List</a>
                                </li>    
                                <li>
                                    <a href="<?php echo URL; ?>books/search">Search</a>
                                </li>
                            </ul>
                    </li>
                   
                    <li <?php if ($this->checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>note/index"><i class="fa fa-pencil"></i> Notes</a>
                    </li>
                
                <?php endif; ?>
              
                <?php if (Session::get('user_logged_in') == true):?>
                    <li <?php if ($this->checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> class="dropdown">
                    <a href="<?php echo URL; ?>login/showprofile" role="button" aria-expanded="false"><i class="fa fa-user"></i> Account</a>

                    <li <?php if ($this->checkForActiveController($filename, "notes")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo URL; ?>login/showprofile#myModal" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Contact</a>
                    </li>
                    </li>
                    
                    <li <?php if ($this->checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo URL; ?>login/logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-question"></i> Help <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                    <a href="<?php echo URL; ?>help/faq">FAQ</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <!-- for not admin users -->    
                <?php if (Session::get('user_account_type') == 2):?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-unlock"></i> Admin <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li>
                        <a href="<?php echo URL; ?>admin/index">Dashboard</a>
                </li>    
                <li>
                        <a href="<?php echo URL; ?>admin/addBook">Add Book</a>
                </li>
                <li>
                        <a href="<?php echo URL; ?>admin/archive">Archive</a>
                </li>
                <li>
                        <a href="<?php echo URL; ?>admin/users">Users</a>
                </li>
                <li>
                        <a href="<?php echo URL; ?>admin/searchIsbn">Search Isbn</a>
                </li>
                <li>
                        <a href="<?php echo URL; ?>admin/bin">Bin</a>
                </li>
                <li>
                        <a href="<?php echo URL; ?>login/logout">Logout</a>
                </li>
                
                </ul>
                </li>
                <?php endif; ?>

            </ul>
              <?php if (Session::get('user_logged_in') == true):?>
            <ul class="nav navbar-nav navbar-right">
              <li><a data-toggle="tooltip" data-placement="bottom" title="reserved books" id="reserved" href="<?php echo URL; ?>books/reserveList"><span class="glyphicon glyphicon-bookmark"></span> <span class="badge"></span></a></li>   
              <li><a data-toggle="tooltip" data-placement="bottom" title="favourite books" id="favourites" href="<?php echo URL; ?>books/favouriteList"><span class="glyphicon glyphicon-star"></span> <span class="badge"></span></a></li>            
              
              <li><a data-toggle="tooltip" data-placement="bottom" title="view profile" href="<?php echo URL; ?>login/showprofile">Logged in as <?php echo Session::get('user_name'); ?></a></li>
            </ul>
              <?php endif; ?> 
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    
    <!-- start modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 id="myModalLabel">Send us a message!</h3>
      </div>
      <div class="modal-body">
        <form role="form" method="post">
	<!--  
		<legend>Contact Form</legend>		-->
		<div class="form-group">
	        <label class="control-label">Name</label>
			<div class="controls">
			    <div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" class="form-control" name="name" placeholder="Name">
				</div>
			</div>
		</div>
		
		
		<div class="form-group">
	        <label class="control-label">Email</label>
			<div class="controls">
			    <div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input type="text" class="form-control" id="email" name="email" placeholder="Email">
				</div>
			</div>	
		</div>
		
		<div class="form-group ">
	        <label class="control-label">Message</label>
			<div class="controls">
			    <div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					<textarea name="message" class="form-control " rows="4" cols="78" placeholder="Enter your message here"></textarea>

				</div>
			</div>
		</div>
		

	      <div class="controls" style="margin-left: 40%;">
		  
	       <button type="submit" class="btn btn-info" >Send Message</button>
	        
	      </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->  
    
