<?php
  require_once "functions.php";

  db_connect();
  $creation_id = $_GET['creation_id'];
  $page = $_SESSION['pname'];


  $sql = "DELETE FROM page_post_creation WHERE post_creation_id = '$creation_id'";
  

  if (mysqli_query($conn,$sql)) {
    redirect_to("page_profile.php?pname=".$page);
  } 
  else {
    echo "Error: " . $conn->error;
  }
