<!DOCTYPE html>
<html>
<head>
<title>Friends Chat Room!</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
   

    <div id="loginform">
    <h2> Welcome to Friends Chat Room! </h2>
    <br/>
    <form action="login.php" method="post">
    	<table class="loginTable">
    		<tr>
    			<td>
    			<label for="name">Your name:&nbsp; </label>
    			</td>
    			 
    			<td>
    			<input type="text" name="name" id="name" value="<?php echo isset($_POST['name'])?htmlspecialchars($_POST['name']):''; ?>" />
    			</td>
    		</tr>
    		<tr>    		
    			<td>
    			 <label for="password">Your password:&nbsp; </label>
    			 </td>
    			<td>
    			<input type="password" name="password" id="password" />
    			</td>
    		</tr>
    		
    	</table>
    
        <br/>
        <br/>
        <input type="submit" name="enter" id="enter" value="Enter" class="button">
        <br/>
         <p>If you are a new user, please <a href = "register.php" class="linkButton">register </a></p>
         
    </form>
    </div>

</body>
</html>
