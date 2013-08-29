<?php

session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "In") {
    header("Location: admin.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <script src="src/scripts/jquery.min.js" type="text/javascript"></script>
    <script src="src/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link media="all" rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link media="all" rel="stylesheet" href="src/style/secret_new.css" type="text/css"/>
    <title>iPass Store</title>
</head>
<body>
<!--div.Wrapper>div#Shelf.>(div.OneLevelShelf span12>(div.OneCard.span3>a.[href="img/SampleCard.png"]>img[src="img/SampleCard.png"]+label[text="CSSA Spring Festival"])*3)*4-->
<div class="Wrapper container">
    <div class="LoginPanel">
    </div>
    <div class="row">
        <h1 class="welcome-message">iPass Store</h1>
        <h4 class="welcome-message">Welcom to the iPassStore admin panel(beta)</h4>

        <div id="login-panel" class="container">
            <form class="form-signin" name="login" action="lib/ws/login.php" method="post">
                <h3 class="form-signin-heading">Please sign in</h3>
                <input type="text" name="username" class="input-block-level" placeholder="UserName">
                <input type="password" name="password" class="input-block-level" placeholder="Password">
                <label class="checkbox" style="display:none;">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                <button class="btn btn-large btn-primary" type="submit" name="action" value="Login">Sign in</button>
            </form>
        </div>
    </div>
    <?php if (isset($_REQUEST['error_message'])) {
        echo "<div class=\"alert alert-error\">";
    } else {
        echo "<div class=\"alert alert-error\" style='display:none'>";
    }?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php  echo "<strong>Error:</strong>   " . $_REQUEST['error_message']  ?>
    </div>
</div>
</body>
