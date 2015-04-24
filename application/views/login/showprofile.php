<style>
/***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/
/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}    




.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    /* background-color: #ffffff; */
    border: 0;
    border-bottom-color: transparent;
}

span.round-tabs{
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: white;
    z-index: 2;
    left: 0;
    text-align: center;
    font-size: 25px;
    margin-bottom: 15px;
}

span.round-tabs.one{
    color: rgb(34, 194, 34);border: 2px solid rgb(0, 153, 203);
}

li.active span.round-tabs.one{
    background: #fff !important;
    border: 2px solid #ddd;
    color: rgb(34, 194, 34);
}

.nav-tabs > li.active > a span.round-tabs{
    background: #fafafa;
}
.nav-tabs > li {
    width: 20%;
}

li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
    
}

.nav-tabs > li a{
   width: 70px;
   height: 70px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}

.tab-content{
}
.tab-pane{
   position: relative;
padding-top: 50px;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}



@media( max-width : 585px ){
    
    .board {
width: 90%;
height:auto !important;
}
    span.round-tabs {
        font-size:16px;
width: 50px;
height: 50px;
line-height: 50px;
    }
    .tab-content .head{
        font-size:20px;
        }
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

li.active:after {
content: " ";
position: absolute;
left: 35%;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}

</style>    


<!-- start test -->
<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->

<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                                <?php if (USE_GRAVATAR) { ?>        
                        <img src='<?php echo Session::get('user_gravatar_image_url'); ?>' class="img-circle img-responsive"
                             style='width:<?php echo AVATAR_SIZE; ?>px; height:<?php echo AVATAR_SIZE; ?>px;' />
                    <?php } else { ?>
                        <img src='<?php echo Session::get('user_avatar_file'); ?>' class="img-circle img-responsive"
                             style='width:<?php echo AVATAR_SIZE; ?>px; height:<?php echo AVATAR_SIZE; ?>px;' />
                    <?php } ?>     
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
					<?php echo Session::get('user_name'); ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="<?php echo URL; ?>login/showprofile">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li>
							<a href="<?php echo URL; ?>login/accountSettings">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
                <div class="row">
    
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    
    
    <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
    	 <div>
            <div class="col-sm-12">
                
                <div class="col-xs-12 col-sm-4 pull-right">              
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-default"><span class="fa fa-gear"></span> Options </button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu text-left" role="menu">
                        <li><a href="#myModal" data-toggle="modal"><span class="fa fa-envelope pull-right"></span> Contact </a></li>
                        <li class="divider"></li>
                        <li><a href=""><span class="fa fa-star pull-right"></span> History  </a></li>
                        <li><a href="#"><span class="fa fa-bookmark pull-right"></span> Option 2 </a></li>
                      </ul>
                    </div>           
                </div>
                
                <div class="col-xs-12 col-sm-8">
                    <h1>Profile</h1>
                    <p><strong>Name: </strong> <a data-toggle="tooltip" data-placement="right" title="edit username" href="<?php URL ?>editusername"> <?php echo Session::get('user_name'); ?> </a> </p>
                    <p><strong>Email: </strong> <a data-toggle="tooltip" data-placement="right" title="edit email" href="<?php URL ?>edituseremail"> <?php echo Session::get('user_email'); ?> </a> </p>
                    <p class="text-muted">Last login: <?php echo $this->lastLoginTime; ?> </p>

                </div>             
                
            </div>            
            <div class="col-xs-12 divider text-center" style="padding-top: 40px;">
                <div class="col-xs-12 col-sm-6 col-md-6 emphasis">
                    <span class="round-tabs one">
                        <div>
                        <h4><a href="<?php echo URL ?>books/favouriteList" alt="favourites" title="favourites"><?php echo count($this->Favcount); ?></a></h4>
                        </div>    
                    </span>
                    <a class="btn btn-default btn-block" data-toggle="tooltip" data-placement="bottom" title="favourites" id="favourites" href="<?php echo URL; ?>books/favouriteList"><span class="fa fa-star"></span> Favourites</a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 emphasis">
                    
                    <span class="round-tabs one">
                        <div>
                        <h4><a href="<?php echo URL ?>books/reserveList" alt="reserved" title="reserved"><?php echo count($this->ReserveCount); ?></a></h4>
                        </div>    
                    </span>       
                    <a class="btn btn-default btn-block" data-toggle="tooltip" data-placement="bottom" title="reserved" id="reserved" href="<?php echo URL; ?>books/reserveList"><span class="fa fa-bookmark"></span> Reserved</a>
                </div>
                
            </div>
    	 </div>                 
		</div>
    
    
  
    
    </div>
            </div>
		</div>
	</div>
</div>
<br>
<br>

