<?php
function getAvatarName($uploadFileName){
  $ext =  pathinfo($uploadFileName, PATHINFO_EXTENSION);
  $fileName = uniqid() . '.' . $ext;
  return $fileName;
}
?>