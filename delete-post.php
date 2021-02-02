<?php
  require_once "functions.php";

  db_connect();
  $creation_id = $_GET['creation_id'];


  $sql = "DELETE FROM user_post_creation WHERE post_creation_id = '$creation_id'";
  

  if (mysqli_query($conn,$sql)) {
    redirect_to("home.php");
  } 
  else {
    echo "Error: " . $conn->error;
  }
