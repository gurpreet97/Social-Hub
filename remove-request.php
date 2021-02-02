<?php
  require_once "functions.php";

  db_connect();

  $user1 = $_SESSION['name'];
  $user2 = $_GET['uname'];

  $sql = "DELETE FROM friend_request WHERE sent_by = '$user2' and sent_to = '$user1'";
  
  if (mysqli_query($conn,$sql)) {
    redirect_to("home.php?name=" . $_SESSION['name']);
  } else {
    echo "Error: " . $conn->error;
  }
