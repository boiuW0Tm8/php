<?php
session_start();
require_once ("modules/function3.php");
require_once ("modules/function2.php");
if(isset($_POST['enter'])){
    //some housekeeping: delete old message logs
    removeOldMessage();
    
    if($_POST['name'] != ""){
        $name = stripslashes(htmlspecialchars($_POST['name']));
        $password = stripslashes(htmlspecialchars($_POST['password']));
        $result = login($name, $password);
        if($result){
            $user = getUser($name);
            $_SESSION['name'] = $name;
            $_SESSION['nickname'] = $user[1];
            $_SESSION['loginTime'] = time();
            $_SESSION['avatar'] = $user[3];
            header("Location: chat.php");
            writeLoginLog();
            die;
        }
        echo '<span class="error">Unable to log in</span>';
        //redirect to chatroom

        
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
   
}else{
    
}
include ("template/loginView.php");

?>










