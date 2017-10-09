<?php
require_once ("modules/function2.php");

session_start();
if(isset($_SESSION['nickname'])){
    $who = $_SESSION['nickname'];
    $text = $_POST['text'];
    $avatar = $_SESSION['avatar'];
    writeChatLog($who, $text, $avatar);
    
}
?>

	