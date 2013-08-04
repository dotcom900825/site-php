<html>
<head>
  <title>Push Panel</title>
  
  <!-- scale down in order to fit the page contents on the iPhone screen -->
  <meta name="viewport" 
        content="initial-scale = 0.75,maximum-scale = 0.75" />
  <style>
    form {border: 1px solid #000000; width: 380px; padding: 10px;
         background: #ffffff; border-radius: 15px;}
    h1 {font:italic bold 20px/30px Georgia, serif;}
    li {padding-top: 8px;}
  </style>
</head>

<body>

	<! Check and display error message -->
  <?php
    if ($_GET['message']!="") 
    {
      print "<error>".$_GET['message']."</error>";
    }
  ?>

  <form action="push.php" method="POST">
  
  Admin Name:
  <input name="admin_name" value=""/><br/><br/>
  
  Admin Password:
  <input name="admin_password" value=""/><br/><br/>

  <input type="submit" id="submit" value="Push to all registered devices"/>
  </form>
</body>

</html>