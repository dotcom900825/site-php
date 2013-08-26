<?php

session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset="UTF-8">
		<script src="src/scripts/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="src/scripts/fancybox/jquery.fancybox-1.3.4_patch.js"></script>
		<link rel="stylesheet" href="src/scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
		<script src="src/scripts/index.js" type="text/javascript"></script>
		<link media="all" rel="stylesheet" href="src/style/index.css" type="text/css" />
		<title>iPass Store</title>
	</head>
	<body>
		<!--div.Wrapper>div#Shelf.>(div.OneLevelShelf span12>(div.OneCard.span3>a.[href="img/SampleCard.png"]>img[src="img/SampleCard.png"]+label[text="CSSA Spring Festival"])*3)*4-->
		<div class="Wrapper container">
        <div class="LoginPanel">
        
        </div>
			<div class="row" >
				<h1>iPass Store</h1>
<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h2 style='font-size:16px;'>Welcome, $username!</h2>";
} else {
    echo "<h2 style='font-size:16px;'>Welcome to the secret login panel of iPassStore!</h2>";

?>
                <form name="login" action="login.php" method="post" >
                Username: <input type="text" name="username" />
                Password: <input type="password" name="password" />
                        <input type="submit" value="Login" name="action"/>
                </form>
                
                
<?php

}

?>
                <form name="logout" action="login.php" method="post">
                <input type="submit" value="Logout" name="action"/>
                </form>
                <form name="login" action="push_panel.php">
                <input type="submit" value="Manage"  />
                </form>
            </div>
		</div>

	</body>