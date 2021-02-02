<?php
  require_once "functions.php";

  db_connect();

  $user1 = $_SESSION['name'];
  $user2 = $_GET['uname'];

  $sql = "INSERT INTO friend_request VALUES ('$user1', '$user2')";

  if (mysqli_query($conn,$sql)) {
    redirect_to("home.php?request_sent=true");
  } else {
    echo "Error: " . $conn->error;
  }
