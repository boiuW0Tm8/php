<!DOCTYPE html>
<html>
<head>
<title>Friends Chat Room!</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
   

    <div id="loginform">
    <h2>Profile Editor: <?php echo $_SESSION['name'];?></h2> 
    <br/>
    <form action="editProfile.php" method="post" enctype="multipart/form-data">
    <table class="RegisterTable">
    			
    		<tr>
    			<td>
    			<label for="nickname">Your nickname:&nbsp; </label>
    			</td>
    			 
    			<td>
    			<input type="text" name="nickname" id="nickname" maxlength="20"  value="<?php echo isset($_POST['nickname'])?htmlspecialchars($_POST['nickname']):$_SESSION['nickname']; ?>" />
    			</td>
    		</tr>
    		
    		<tr>
    		<td colspan="2">
    			<span class = "error"><?php echo (isset($nicknameError))?$nicknameError:'';?></span>
    		</td>
    		</tr>
    		
    		
    		<tr>    		
    			<td>
    			 <label for="password">Your password:&nbsp; </label>
    			 </td>
    			<td>
    			<input type="password" name="password" id="password"  maxlength="20" />
    			</td>
    		</tr>
    		
    		<tr>
    		<td colspan="2">
    			<span class = "error"><?php echo (isset($passwordError))?$passwordError:'';?></span>
    		</td>
    		</tr>
    		
    		<tr>
    			<tr>
    			<td>
    			<label for="confirm_password">Confirm password:&nbsp; </label>
    			</td>
    			 
    			<td>
    			<input type="password" name="confirm_password" id="confirm_password" />
    			</td>
    		</tr>
    		<!-- confirmation validation error -->
    		<tr>
    			<td colspan="2">
    				<span class = "error"><?php echo (isset($confirmError))?$confirmError:'';?></span>
    			</td>
    		</tr>
    		
    		<tr>
    			<td>
    			 <label for="avatar">Your avatar:&nbsp; </label>
    			</td>
    			
    			<td>
    			<input type="file" name="avatar" id="avatar" />
    			</td>
    		</tr>

    	
    	</table>
        
         
        
        <br/>
        <br/>
        <input type="submit" name="submit" id="submit" value="Submit" class="button"/>
        <a href = "chat.php" class="linkButton">Cancel</a>
    </form>
    </div>
   

</body>
</html>
