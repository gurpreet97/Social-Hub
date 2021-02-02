<?php 
	require_once "functions.php";
	db_connect();

	
	
	$post_id = $_GET['post_id'];
	$page = $_SESSION['pname'];
	$post_creation_id = bin2hex(random_bytes(40));
	$creation_time = date("Y-m-d H:i:s");

	$sql = "INSERT into page_post_creation values('$post_creation_id','$page','$post_id','$creation_time')";
	
	if(mysqli_query($conn,$sql)){
		redirect_to("page_profile.php?pname=".$page);
	}
	else{
		echo "Error: " . $conn->error;
	}


?>