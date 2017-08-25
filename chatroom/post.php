<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    
    $fp = fopen("log.html", 'a');
    $when = date("g:i A");
    $who = $_SESSION['name'];
    $sayWhat = stripslashes(htmlspecialchars($text));
    $msg = "<div class='msgln'>($when) <b>$who</b>: $sayWhat<br></div>";
    fwrite($fp, $msg);
    fclose($fp);
}
?>

	