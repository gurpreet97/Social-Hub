<?php
  require_once "functions.php";

  db_connect();

  $name = $_POST["name"];
  $password = $_POST["password"];

  $query1 = "SELECT * FROM user WHERE name = '$name'";
  $query2 = "SELECT * FROM page WHERE pname = '$name'";

  $result1 = mysqli_query($conn,$query1);
  $result2 = mysqli_query($conn,$query2);

  if(mysqli_num_rows($result1)==1){
    echo "user\n";
    $sql = "SELECT password from user where name = '$name'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $password1 = $row['password'];
    echo md5($password);
      echo "\n";
      echo $password1;
    if(md5($password)==$password1){
      $_SESSION['name'] = $name;
      $_SESSION['pname'] = "";
      echo "1111111111\n";

    
      redirect_to("home.php");
    }
    else{
      echo "2222222\n";
      redirect_to("index.php?login_error=true");
    } 
  }
  else if(mysqli_num_rows($result2)==1){
    echo "page\n";
    $sql = "SELECT password from page where pname = '$name'";
     $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $password1 = $row['password'];
    if(md5($password)==$password1){
      $_SESSION['pname'] = $name;
      $_SESSION['name'] = "";
      redirect_to("page_profile.php?pname=".$name);
    }
    else{
      echo "not";
      echo $password1;
      echo md5($password);
      //redirect_to("index.php?login_error=true");
    }
  }
  else{
    echo "nothing\n";
    redirect_to("index.php?login_error=true");
  }

 