<?php
  require_once "functions.php";

  db_connect();

  $user1 = $_SESSION['name'];
  $user2 = $_GET['uname'];

  $sql = "DELETE FROM have_friend WHERE (name = '$user1' AND friend_name = '$user2') OR (name = '$user2' AND friend_name = '$user1')";
  

  if (mysqli_query($conn,$sql)) {
    redirect_to("profile.php?name=" . $_SESSION['name']);
  } else {
    echo "Error: " . $conn->error;
  }
