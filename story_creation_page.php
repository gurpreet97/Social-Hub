<?php 
	require_once "functions.php";
	db_connect();

	
	$story_id = $_GET['story_id'];
	$page = $_SESSION['pname'];
	
	

	$sql = "INSERT into page_have_story values('$page','$story_id')";
	
	if(mysqli_query($conn,$sql)){
		redirect_to("page_profile.php?pname=".$page);
	}
	else{
		echo "Error: " . $conn->error;
	}


?>