<?php 
$ft = $_GET['type'];

if ($ft == 'tCheck'){
if (!$_GET['access_token']){
    echo "window.location = ''";
}
else {
    
$token = "?token=".$_GET['access_token'];
//Structure
}
}
?>