<?php 
	require_once "functions.php";
	db_connect();

	$privacy = $_GET['privacy'];
	$creation_type = $_GET['creation_type'];
	$post_id = $_GET['post_id'];
	$user = $_SESSION['name'];
	$post_creation_id = bin2hex(random_bytes(40));
	$creation_time = date("Y-m-d H:i:s");

	$sql = "INSERT into user_post_creation values('$post_creation_id','$user','$post_id','$creation_time','$privacy','$creation_type')";
	
	if(mysqli_query($conn,$sql)){
		redirect_to("home.php");
	}
	else{
		echo "Error: " . $conn->error;
	}


?>