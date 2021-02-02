<?php 
	require_once "functions.php";
	db_connect();

	$user = $_SESSION['name'];
	$page = $_GET['pname'];
	

	$query = "SELECT * from user_like_page where pname = '$page' and name = '$user' ";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0){
		$sql = 	"INSERT into user_like_page values ('$user','$page')";
		if(mysqli_query($conn,$sql)){
			redirect_to("home.php");
		}
		else{
			echo "Error: " . $conn->error;
		}	
	}
	else{
		$sql = 	"DELETE from user_like_page where pname = '$page' and name = '$user'";
		if(mysqli_query($conn,$sql)){
			redirect_to("profile.php?name=".$user);
		}
		else{
			echo "Error: " . $conn->error;
		}
	}

 ?>
