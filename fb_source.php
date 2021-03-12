<?php 
include './php-graph-sdk-4.0-dev/autoload.php';
include('./fbconfig.php');
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginURL = $helper->getLoginURL('http://localhost:8080/iRead/fb_callback.php', $permissions);
?>