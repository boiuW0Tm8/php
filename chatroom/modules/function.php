<?php
function writeChatLog($user, $message){
    $fp = fopen("log.html", 'a');
    $when = date("g:i A");
    $sayWhat = stripslashes(htmlspecialchars($message));
    $msg = "<div class='msgln'>($when) <b>$user</b>: $sayWhat<br></div>";
    fwrite($fp, $msg);
    fclose($fp);
}

function writeExitLog() {
        $fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
        fclose($fp);
}

function writeLoginLog() {
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has entered the chat session.</i><br></div>");
    fclose($fp);
}