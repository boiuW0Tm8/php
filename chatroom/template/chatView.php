<!DOCTYPE html>
<html>
<head>
<title>Friends Chat Room!</title>
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>


    <div id="wrapper">
        <div id="menu">
            <p class="welcome">Welcome, <b><?php echo $_SESSION['nickname']; ?></b>
            <a id="edit" href="editProfile.php">Edit Profile</a></p> 
            <p class="logout"><a id="exit" href="javascript:void(0);">Exit Chat Room</a></p>
            <div style="clear:both"></div>
        </div>    
        <div id="chatbox"></div>
         
        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" class="button"/>
            <!-- <img src="assets/smileys/grin.gif" alt="grin" class="emojiButton">  -->
            <i class="fa fa-smile-o emojiButton" aria-hidden="true"></i>
        </form>
        <div id="popup">
        <table>
        <tr>
        <?php
		$i=0;
		foreach ($emojis as $key => $smiley){
        	$filename=$smiley[0];
        	$alt=$smiley[1];
		?>

		<?php if($i>0 && $i % 8 == 0 ) { ?>

	
		<tr/><tr>
		<?php }?>
        <td>
			<img src='assets/smileys/<?php echo $filename;?>' alt='<?php echo $alt;?>' data-emoji='<?php echo $key;?>' class='faces'>    
        </td>
        
        <?php
			$i++; 
		}?>
		
        </tr>
        </table>
        </div>
        
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
    // jQuery Document
    $(document). ready(function(){
    	//If user wants to end session
    	$("#exit").click(function(evt){
    		var exit = confirm("Are you sure you want to end the session?");
    		if(exit==true){
    			window.location = 'chat.php?logout=true';
    		}
    		evt.preventDefault();
    		
    	});
    	
    	//faces click handler
    	$('.faces').click(function(){
    		var msg=$('#usermsg').val();
    		var emoji=$(this).attr("data-emoji");
    		$('#usermsg').val(msg+emoji);
    	});
    	//emojiButton click handler
    	$('.emojiButton').click(function(){
    		//alert("teehee");    		
    		var p=$(this).position();
            var height=$(this).height();
    		$("#popup").css({ top: p.top + height + 4, left: p.left - 8});
    		$("#popup").slideToggle();	
    });
    	
    	
    });
    </script>




<script>
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});	
</script>


<script>
//Load the file containing the chat log
	//Load the file containing the chat log
	function loadLog(){
		//console.log("loading...");		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "readlog.php",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
//---------------------------------------------------------------------
</script>

<script type="text/javascript">
setInterval (loadLog, 500);	//Reload file every 2500 ms or x ms if you wish to change 
</script>

</body>
</html>
