<?php
// Initialize the session
	session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header('location: index.php');
    exit;
}
	$uid=$_SESSION['uid'];
	include'admin_connection.php';

	
	$query = mysqli_fetch_array(mysqli_query($tcon,"SELECT * FROM user where uid='$uid'"));
	$uid=$query['uid'];
?>