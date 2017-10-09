<?php
require_once 'library/db.php';
require_once 'modules/emoji.php';
function writeChatLog($user, $message, $avatar){
    $when = date("g:i A");
    $sayWhat = stripslashes(htmlspecialchars($message));
   // $msg = "<div class='msgln'>($when) <b>$user</b><img class='avatar' src='$avatar'>: $sayWhat<br></div>";
   $msg = <<<EOT
      <div class='msgln clearfix'>
        <img class='avatar' src='$avatar'>
         <p class='clearfix'><b>$user</b>:<span class="date">($when)</span></p>
         $sayWhat 
      </div>  
EOT;
    
    
    //emoji array
    $smileys = getEmojis();
    
    
    foreach ($smileys as $key => $smiley){
        $filename=$smiley[0];
        $alt=$smiley[1];
        $img = "<img src='assets/smileys/$filename' alt='$alt' class='emoji'>";
        $msg = str_replace($key, $img, $msg);
    }
    
    writeARow($msg);
}

function writeExitLog() {
    //         $fp = fopen("log.html", 'a');
    //         fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    //         fclose($fp);
    
    $msg = "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>";
    writeARow($msg);
    
}

function writeLoginLog() {
    //     $fp = fopen("log.html", 'a');
    //     fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has entered the chat session.</i><br></div>");
    //     fclose($fp);
    
    $msg = "<div class='msgln'><i>User ". $_SESSION['nickname'] ." has entered the chat session.</i><br></div>";
    writeARow($msg);
}

function writeRegisterLog() {
    $msg = "<div class='msgln'><i>New user ". $_SESSION['nickname'] ." has entered the chat session.</i><br></div>";
    writeARow($msg);
}
function writeARow($message){
    $conn = connectDb();
    
    $messageTime = time();
    
    $message = mysqli_real_escape_string($conn, $message);
    
    $sql = "INSERT INTO `message_log` (`message_time`, `message`) VALUES ($messageTime, '$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function readLog($loginTime){
    $conn = connectDb();
    
    $sql = "SELECT id, message_time, message FROM message_log where message_time >= $loginTime";
    $result = $conn->query($sql);
    
    $allMessage = '';
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            //echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
            $allMessage = $allMessage . $row['message'];
        }
    } else {
        //echo "0 results";
    }
    
    $conn->close();
    return $allMessage;
}

function removeOldMessage(){
    $yesterday=strtotime("-1 day");
    $sql="Delete From message_log where message_time < $yesterday";
    $conn = connectDb();
    $result = $conn->query($sql);
    $conn->close();
}


