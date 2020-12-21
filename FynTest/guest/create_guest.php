<?php

include("guest_dbconnection.php");

 if(isset($_POST['registerbtn'])){
// Escape user inputs for security
$g_name = mysqli_real_escape_string($gcon, $_POST['g_name']);
$g_email = mysqli_real_escape_string($gcon, $_POST['g_email']);

$query = mysqli_query($gcon,"select *  from `guest` where `g_email`='$g_email'");
	if(mysqli_num_rows($query)>0)
	{
		header("Location:index.php?id=2");
	}
	else{

// attempt insert query execution
$sql = "INSERT INTO guest (g_name,g_email) VALUES ('$g_name','$g_email')";

if(mysqli_query($gcon, $sql))
{   $id=mysqli_insert_id($gcon);
	header("Location:test.php?id=$id&testQualifier=1");
} 
else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($gcon);
	}
	}


	

// close connection
mysqli_close($gcon);
}
else{
    echo '<h3>How you manage to come here?</h3>';
}
?>
