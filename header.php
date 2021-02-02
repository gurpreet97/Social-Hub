<?php require_once "functions.php"; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Social Hub</title>

  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <!-- nav -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Social Hub</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <?php if(is_auth()): ?>

          <?php 
            if($_SESSION['name'] != ""){

          ?>

          <li><a href="home.php">Home</a></li>
          <li><a href="profile.php?name=<?php echo $_SESSION['name']; ?>">Profile</a></li>

        <?php } ?>

        <?php 
            if($_SESSION['pname'] != ""){

          ?>

           <li><a href="page_profile.php?pname=<?php echo $_SESSION['pname']; ?>">Profile</a></li>

        <?php } ?>

          <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
  <!-- ./nav -->