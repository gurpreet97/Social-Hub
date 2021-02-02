<?php 
	require_once "functions.php";
	db_connect();

	$user = $_SESSION['name'];
	$creation_id = $_GET['creation_id'];

	$query = "SELECT * from like_post where creation_id = '$creation_id' and name = '$user' ";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0){
		$sql = 	"INSERT into like_post values ('$user','$creation_id')";
		if(mysqli_query($conn,$sql)){
			redirect_to("home.php");
		}
		else{
			echo "Error: " . $conn->error;
		}	
	}
	else{
		$sql = 	"DELETE from like_post where creation_id = '$creation_id' and name = '$user'";
		if(mysqli_query($conn,$sql)){
			redirect_to("home.php");
		}
		else{
			echo "Error: " . $conn->error;
		}
	}

 ?>
