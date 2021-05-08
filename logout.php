<?php session_start(); 
 
if (isset($_SESSION['username'])){
     session_destroy(); // delete session login
}
header("Location: ./login.php");
?>
