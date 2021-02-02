<?php 
	require_once "functions.php";
	db_connect();

	$user = $_SESSION['name'];
	$creation_id = $_GET['creation_id'];
	$comment_id = bin2hex(random_bytes(40));
	$content = $_POST['content'];

	$sql = 	"INSERT into comment values ('$comment_id','$content','$user','$creation_id')";
	if(mysqli_query($conn,$sql)){
		redirect_to("comment.php?creation_id=".$creation_id);
	}
	else{
		echo "Error: " . $conn->error;
	}	

 ?>
