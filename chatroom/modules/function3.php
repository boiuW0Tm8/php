<?php

include 'library/db.php';

function writeUser($regName, $regNickname,  $regPassword, $avatar){
   
    // Create connection
    $conn = connectDb();
    
    $sql = "INSERT INTO `user` (`username`, `nickname`, `password`, `avatar`) VALUES ('$regName', '$regNickname', '$regPassword', '$avatar')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function updateUser($regName, $regNickname,  $regPassword, $avatar){
    
    // Create connection
    $conn = connectDb();
    
    //update nickname
    $sql = "UPDATE user SET nickname='$regNickname'";
    $where =  " WHERE username='$regName'";

    //update password
    
    if ($regPassword!==''){
        $sql .= ", password='$regPassword'";
    }
    
    if ($avatar!==''){
        $sql .= ", avatar='$avatar'";
    }
    
    $sql .= $where;
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Profile Edited successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    
    $conn->close();
}

function login($youName, $youPassword){
    $conn = connectDb();
    
    $sql = "SELECT count(*) FROM user where username = '$youName' and password = '$youPassword'";
    $query = $conn->query($sql);
    
    $count = $query->fetch_row();
    $conn->close();
    if($count[0] == 0)return false;
    else return true;
}
function getUser($youName){
    $conn = connectDb();
    
    $sql = "SELECT username, nickname,  password, avatar FROM user where username = '$youName'";
    $query = $conn->query($sql);
    
    $user = $query->fetch_row();
    return $user;
}
function getUserByNickname($nickname, $username=''){
    $conn = connectDb();
    
    $sql = "SELECT username, nickname,  password, avatar FROM user where nickname = '$nickname'";
    
    if($username !== ''){
        $sql .=  " and username <> '$username'";
    }
    
    $query = $conn->query($sql);
    
    $user = $query->fetch_row();
    return $user;
}



