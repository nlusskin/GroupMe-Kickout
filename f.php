<?php 
if (!$_GET['access_token']){
    echo "window.location = 'https://oauth.groupme.com/oauth/login_dialog?client_id=NkuhJN7TVOnFFMar9YbaHe8OCGezw8TuPh5vxodpl1sQNz7M'";
}
else {
    
$token = "?token=".$_GET['access_token'];
//Structure

}
?>