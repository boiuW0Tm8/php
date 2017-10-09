<?php
require_once ("modules/function2.php");
require_once ("modules/emoji.php");
session_start();
if(isset($_GET['logout'])){
    
    //Simple exit message
//     $fp = fopen("", 'a');
//     fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
//     fclose($fp);
    writeExitLog();
    
    session_destroy();
    $_SESSION = [];
    header("Location: index.php");//Redirect the user
    die;
}
$emojis = getEmojis();
include "template/chatView.php";
?>








