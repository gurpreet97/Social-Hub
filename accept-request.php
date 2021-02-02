<?php
  require_once "functions.php";

  db_connect();

  // add users to friends table
  $user1 = $_SESSION['name'];
  $user2 = $_GET['uname'];

  $sql = "INSERT INTO have_friend (name, friend_name) VALUES ('$user1','$user2'), ('$user2', '$user1')";


  // remove friend request
  if (mysqli_query($conn,$sql)) {
    redirect_to("remove-request.php?uname=" . $_GET['uname']);
  } else {
    echo "Error: " . $conn->error;
  }
