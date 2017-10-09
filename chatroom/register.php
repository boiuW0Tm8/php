<?php
session_start();
require_once ("modules/function3.php");
require_once ("modules/function2.php");
require_once ("library/file.php");
if(isset($_POST['submit'])){
    $target_dir = "uploads/";
    $avatar_def = "uploads/onon.png";
    //$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    
    $target_file = $target_dir . getAvatarName(basename($_FILES["avatar"]["name"]));
    $avatar = $avatar_def;

    //retrieve values
    $name = stripslashes(htmlspecialchars($_POST['name']));
    $name = trim($name);
    $nickname = stripslashes(htmlspecialchars($_POST['nickname']));
    $nickname = trim($nickname);
    $password = stripslashes(htmlspecialchars($_POST['password']));
    $password = trim($password);
    $confirmPassword =  stripslashes(htmlspecialchars($_POST['confirm_password']));
    $confirmPassword = trim($confirmPassword);
    
    $validError = false;
    
    //validation ---------------------------------------------
    //1. valid name
    if($name == "") {
        $nameError = "You must type in a name";
        $validError = true;
    }
    else {
        $user = getUser($name);
        if($user) {
            $nameError = "Sorry, this name has already been taken";
            $validError = true;
            
        }
    }
    
    //valid nickname
    
    if($nickname == "") {
        $nicknameError = "You must type in a nickname";
        $validError = true;
    }
    else {
        $user = getUserByNickname($nickname);
        if($user) {
            $nicknameError = "Sorry, this nickname has already been taken";
            $validError = true;
            
        }
    }
    
    //2. valid password
    
    if(strlen($password) < 6 || strlen($password) > 20) {
        $passwordError = "Password must be between 6 and 20 characters long";
        $validError = true;
    }
    
    if ($validError) {
        include ("template/registerView.php");
        die;
    }
    
    //validate confirm password
    if ($confirmPassword <> $password){
        $confirmError = "The passwords do not match";
        $validError = true;
    }
    
    if ($validError) {
        include ("template/registerView.php");
        die;
    }
    
    
    //validate avatar
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Sorry, but there is either no file selected, or the file is corrupt or does not work.";
        $uploadOk = 0;
    }
    
    if ($uploadOk){
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $avatar = $target_file;
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
    
    if($_POST['name'] == "" || $_POST['password'] == ""){
        echo '<span class="error">Please type in a name</span>';
        header("Location: register.php");
    }  else{
        writeUser($name, $nickname, $password, $avatar);
        
        $_SESSION['name'] = $name;
        $_SESSION['nickname'] = $nickname;
        $_SESSION['loginTime'] = time();
        $_SESSION['avatar'] = $avatar;
        header("Location: chat.php");
        writeRegisterLog();
        die;
    }
   
}else{
    
}
include ("template/registerView.php");


?>










