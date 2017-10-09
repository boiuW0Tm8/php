<?php
session_start();

if(!isset($_SESSION['name'])){
    //log in
    header("Location: login.php");
    die();
}
else{
    //chat room
    header("Location: chat.php");
    die();
}
?>
