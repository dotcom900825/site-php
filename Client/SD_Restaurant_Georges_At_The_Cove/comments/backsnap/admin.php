<?php
//======================================================================//
// ! BACKSNAP ADMIN PAGE
// - Timestamp: [[ 01-29-2013 09:15:25 am by Mike Yrabedra (mikeyrab) ]]
//======================================================================//
//======================================================================//
// ! GRAB CONTROL FILE
//======================================================================//
$control_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'control.php' ;
if (file_exists($control_file)) {
	@require_once($control_file);
}else{
	exit("Error: Config File Could not be found at path = {$control_file} ");
}

//======================================================================//
// ! INIT
//======================================================================//
$alert='';
$backsnap = new BackSnap;
$rs = $backsnap->init($config);
if($rs != 'good')
	exit("Error: {$rs} ");

// remember page
$page = (isset($_GET['page'])) ? $_GET['page'] : '';

// Are we logged in?

if(isset($_POST))
{
	$p = $_POST;
	
	$action = (isset($p['backsnap_action'])) ? $p['backsnap_action'] : '';
	
	if(isset($p['delete_all']) && $p['delete_all'] == 'yes')
		$action = 'delete_all';
	
	switch($action) 
	{
	
		case 'edit_posts':
			$posts = (isset($p['post'])) ? $p['post'] : null ;
			if($posts) {
			foreach($posts as $v) {
			
				$delete = (isset($p['delete'][$v]))?1:0;
				$spam = (isset($p['spam'][$v]))?1:0; // if marked spam, report to akismet and delete
				$page = (isset($p['page'])) ? $p['page'] : null ;
				$author = (isset($p['author'][$v])) ? $p['author'][$v] : '';
				$email = (isset($p['email'][$v])) ? $p['email'][$v] : '';
				$message = (isset($p['message'][$v])) ? $p['message'][$v] : '';
				$followup = (isset($p['followup'][$v])) ? $p['followup'][$v] : '';
				$rating = (isset($p['rating'][$v])) ? $p['rating'][$v] : 0 ;
				$url = (isset($p['url'][$v])) ? $p['url'][$v] : '';
				
					
					if($spam && $config['use_akismet'])
						$backsnap->akismetSubmitSpam($author, $email, $message);
					 
					 if($delete) {
					 	$backsnap->deletePost($v); // delete
					 }else{
					 	$backsnap->updatePost($v, $page, $author, $email, $message, $rating, $followup, $url); // update
					 }
					
				} // foreach
				
				$alert = '<div class="alert alert-success alert-block"><h4 class="alert-header">Success!</h4>Your changes have been saved successfully.</div>';
			}
		break;
		
		case 'edit_config' :
		
		$backsnap->updateConfig($p);
		
		$alert = '<div class="alert alert-success alert-block"><h4 class="alert-header">Success!</h4>Your changes have been saved successfully.</div>';
		
		break;
		
		case 'delete_all' :
		
		$page = (isset($p['page'])) ? $p['page'] : null ;
		$backsnap->deleteAll($page);
		$alert = '<div class="alert alert-success alert-block"><h4 class="alert-header">Success!</h4>Your changes have been saved successfully.</div>';
		
		break;
		
		case 'login' :
		
			if($backsnap->login($p['backsnap-user'], $p['backsnap-pass']))
			{
				$_SESSION['backsnap_logged_in'] = 'true';
				
			}else{
			
				$alert = '<div class="alert alert-block"><h4 class="alert-header">Login Failed</h4>The credentials you provided are not valid. Please try again.</div>';
			}
			
		
		break;
		
		
		case 'logout' :
		
			unset($_SESSION['backsnap_logged_in']);
		
		break;
		

	
	} // switch
	
$logged_in = (isset($_SESSION['backsnap_logged_in'])) ? true : false;


}

?><!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>BackSnap Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
	<!--[if IE 7]>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css" rel="stylesheet">
	<![endif]-->
    <link href="assets/css/colorpicker.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo $_SERVER['PHP_SELF']; ?>"><i class="icon-dashboard icon-large"></i> BackSnap Admin</a>
          <div class="nav-collapse collapse">
            <?php if($logged_in): ?>
              <form method="post" class="navbar-form pull-right">
              <input type="hidden" name="backsnap_action" value="logout">
              <button  class="btn btn-small btn-inverse"><i class="icon-signout"></i> Logout</button>
              </form>
             <?php endif; ?>
             <ul class="nav">
              <?php if($logged_in): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
                <ul class="dropdown-menu">
	                <?php echo $backsnap->getPages($page); ?>
                </ul>
              </li>
              <?php endif; ?>
              <li><a href="http://yabdab.com/help/stacks/backsnap/" target="_blank">Need Help?</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    


    <div class="container">
    
    
   <?php if(!$logged_in): ?>
  
   
     <div class="block">
	     <div class="block-header"><h2>Admin Login </h2></div> 
	     <div class="block-body">
	     
	        	<?php echo $alert; ?>
	        
			   <form method="post" class="form-horizontal">
			   <div class="control-group">
			   <label class="control-label">Username</label>
			   <div class="controls">
			   <input type="text" name="backsnap-user" placeholder="Admin User">
			   </div>
			   </div>
			   
			   <div class="control-group">
			   <label class="control-label">Password</label>
			   <div class="controls">
			   <input type="text" name="backsnap-pass" placeholder="Admin Pasword">
			   </div>
			   </div>
			   <input type="hidden" name="backsnap_action" value="login">
			   
		   </div>
		   <div class="block-footer">
		   <input type="submit" class="btn btn-primary" value="Login">
		   </div>
			
		   </form>
   </div>
    
    
    
    <?php else: ?>
    
    	 <div class="block">
    	   <div class="block-header">
        
         <?php 
         
         if($page):
         
        // $config = $backsnap->getPostConfig($page); ?> 
	           
	     	<h2>Edit <small><?php echo $page; ?></small></h2>
	     </div> 
	     <div class="block-body">
        
        <?php echo $alert; ?>
        <?php echo $backsnap->editPostsForm($page); ?>
        
        <?php else: ?>
        
	     	<h2>Dashboard</h2>
	     </div> 
	     <div class="block-body">
        
        <?php echo $alert; ?>
        <?php echo $backsnap->dashboardView(); ?>
        
        <?php endif; // page exists ?>
        
	     </div>
	     <div class="block-footer"></div>
	     </div>
    



      <?php endif; ?>
      
      <footer> &copy;  BackSnap | Yabdab Inc. 2012</footer>
      

    </div><!--/.container-->

    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-colorpicker.js"></script>
    <script src="assets/js/admin.js"></script>

  
<?php $backsnap->closeConnection(); ?>
</body></html>