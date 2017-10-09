<?php
session_start();
require_once ("modules/function3.php");
require_once ("library/file.php");
if (!isset($_SESSION['name'])) {
    header('location: login.php');
    die;
}

if(isset($_POST['submit'])){
    $target_dir = "uploads/";
    //$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $target_file = $target_dir . getAvatarName(basename($_FILES["avatar"]["name"]));
    $avatar = "";

    //retrieve values
    $nickname = stripslashes(htmlspecialchars($_POST['nickname']));
    $nickname = trim($nickname);
    $password = stripslashes(htmlspecialchars($_POST['password']));
    $password = trim($password);
    $confirmPassword =  stripslashes(htmlspecialchars($_POST['confirm_password']));
    $confirmPassword = trim($confirmPassword);
    
    $validError = false;
    
    //validation ---------------------------------------------
   
    //valid nickname
    
    if($nickname == "") {
        $nicknameError = "You must type in a nickname";
        $validError = true;
    }
    else {
        $user = getUserByNickname($nickname, $_SESSION['name']);
        if($user) {
            $nicknameError = "Sorry, this nickname has already been taken";
            $validError = true;
            
        }
    }
    
  
    if($password != ""){
        //2. valid password
        if (strlen($password) < 6 || strlen($password) > 20) {
            $passwordError = "Password must be between 6 and 20 characters long";
            $validError = true;
        }
        
        //validate confirm password
        if ($confirmPassword <> $password){
            $confirmError = "The passwords do not match";
            $validError = true;
        }
    }
    
   
    
    if ($validError) {
        include ("template/editView.php");
        die;
    }
    
    
    //validate avatar
    if (isset($_FILES["avatar"])){
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Sorry, but there is either no file selected, or the file is corrupt or does not work.";
            $uploadOk = 0;
        }
    } else {
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
    
   
    updateUser($_SESSION['name'], $nickname, $password, $avatar);
    
    $_SESSION['nickname'] = $nickname;
    $_SESSION['loginTime'] = time();
    
    if ($avatar != ''){
        $_SESSION['avatar'] = $avatar;
        //die;
    }
    

    header("Location: chat.php");
    
    die;
    
   
}else{
    
}
include ("template/editView.php");


?>










