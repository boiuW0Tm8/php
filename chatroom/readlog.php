<?php
require ("modules/function2.php");

session_start();
if(isset($_SESSION['loginTime'])){
    $loginTime = $_SESSION['loginTime'];
}else{
    $loginTime = 0;
}

$log = readLog($loginTime);
echo $log;