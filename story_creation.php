<?php 
	require_once "functions.php";
	db_connect();

	
	$story_id = $_GET['story_id'];
	$user = $_SESSION['name'];
	
	

	$sql = "INSERT into user_have_story values('$user','$story_id')";
	
	if(mysqli_query($conn,$sql)){
		redirect_to("profile.php?name=".$user);
	}
	else{
		echo "Error: " . $conn->error;
	}


?>