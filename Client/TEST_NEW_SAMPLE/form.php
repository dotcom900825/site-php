<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--************************************************************-->
<title>iPass Store - Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="../../src/jquery.mobile/jquery.mobile-1.3.2.min.css" />
<script src="../../src/scripts/jquery.min.js"></script>
<script src="../../src/jquery.mobile/jquery.mobile-1.3.2.min.js"></script>

</head>

<script>
    function checkTerm(){
        if($("input#checkTerms").is(':checked')){
            $("button#submitButton").button('enable');
        }
        else{
            $("button#submitButton").button('disable');
        }
    }
</script>
<!--Error Message Style-->
<style>
div.InputContainer>label{
	font-weight:bold;
}
.ui-header .ui-title {
    margin-right: 10%;
    margin-left: 10%;
}
.error{
	text-align:center;
	color:red;
}
</style>

<body id="main_body" >
	
	 <div data-role="page" data-theme="d" id="page1">
            <div data-role="header" id="hdrMain" >
                <h1>Test New</br>Digital Membership Card</h1>
            </div>
            <div data-role="content" id="contentMain" name="contentMain">
                <form id="form1" action="getpass.php" method="post">
                    <div id="fnameDiv" data-role="fieldcontain" class="InputContainer">
                        <label for="fname" id="fnameLabel" name="fnameLabel">First name</label>		
                        <input id="fname" name="first_name" type="text" />
                    </div>

                    <div id="lnameDiv" data-role="fieldcontain" class="InputContainer">
                        <label for="lname">Last name</label>		
                        <input id="lname" name="last_name" type="text" />
                    </div>
                    <div id="emailDiv" data-role="fieldcontain" class="InputContainer">
                        <label for="email">Email</label>		
                        <input id="email" name="user_email" type="text" />
                    </div>
                    <div data-role="fieldcontain" class="InputContainer">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" value="" />
                    </div>
            <div data-role="fieldcontain" class="InputContainer">
                <fieldset data-role="controlgroup">
                    <legend><a href="../../terms.html" target="_blank" rel="external">Terms and Conditions</a></legend>
                    <label><input id="checkTerms" type="checkbox" name="checkTerms" onchange="checkTerm()">I agree</label>
                </fieldset>
            </div>
                     <input type="hidden" name="folder" value="TEST_NEW_SAMPLE"/>
                    <input type="hidden" name="id" value="2"/>
                    <button type="submit" value="Submit Values" >Submit</button>
                <div>
			<h3 class="error">
			<?php
		 	if ($_GET['message']!="") 
		 	{
		 		print "<error>".$_GET['message']."</error>";
		 	}
			?>	
			</h3>
				</div>
				</form>
            </div>
        </div>
	</body>
</html>
