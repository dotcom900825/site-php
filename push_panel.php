<?php

session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
	header("Location: secret.php");
}
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

if (isset($_GET['message'])){
	$message = $_GET['message'];
	echo "<h3>$message</h3>";
}

?>

  <form action="/lib/ws/push.php" method="POST">
  
  Admin Name:
  <input name="admin_name" disabled value=""/><br/><br/>
  
  Admin Password:
  <input name="admin_password" disabled value=""/><br/><br/>
  
  Card Name:
  
  <?php

$options = DataInterface::getCardNamesAndIdByUsername($_SESSION['username']);
if ($options == null) {
    print "<p><strong>No cards created yet!</strong></p>";
} else {
    print "<select name='cardId'>";
    foreach ($options as $cardName => $cardId) {
        print "<option value='$cardId'>$cardName</option>";
    }
    print "</select>";
}

?>
<br/><br/>
  
  Header Field Label:
  <input name="header_field_label" disabled value=""/><br/><br/>
  
  Header Field Value:
  <input name="header_field_value"  value=""/><br/><br/>
  
  Middle Auxiliary Field Label:
  <input name="middle_auxiliary_field_label" disabled value=""/><br/><br/>
  
  Middle Auxiliary Field Value:
  <input name="middle_auxiliary_field_value" disabled value=""/><br/><br/>
  
  Right Auxiliary Field Label:
  <input name="right_auxiliary_field_label" disabled value=""/><br/><br/>
  
  Right Auxiliary Field Value:
  <input name="right_auxiliary_field_value" disabled value=""/><br/><br/>
  
  Top Back Field Label:
  <input name="top_back_field_label" disabled value=""/><br/><br/>
  
  Top Back Field Value:
  <input name="top_back_field_value" disabled value=""/><br/><br/>
  

  <input type="submit" id="submit" value="Push to all registered devices"/>
  </form>
</body>

</html>