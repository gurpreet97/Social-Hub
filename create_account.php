<?php
  // session_start();
  $errors = array();
  require_once "functions.php";
  // require_once "error.php";

  $username = "";
  $email="";
  $designation = "";
  $employeeid = "";
  $name = "";
  $pname = "";
  $ph_no = "";
  $gender = "";
  $admin_name = "";

  

  db_connect();

  if(isset($_POST['register_user'])){
      $name = $_POST["name"];
      $email = $_POST["email"];
      $ph_no = $_POST["ph_no"];
      $dob = $_POST["dob"];
      $gender = $_POST["gender"];
      $password = $_POST["password"];

    if(empty($name))
    {
      // echo "name";
      array_push($errors, "Name is required.");
    }
    if(empty($email))
    {
      // echo "email";
      array_push($errors, "Email is required.");
    }
    if(empty($ph_no))
    {
      // echo "ph_no";
      array_push($errors, "Phone No. is required.");
    }
    if(empty($password))
    {
      // echo "pass";
      array_push($errors, "Password is required.");
    }
    if(empty($dob))
    {
      // echo "dob";
      array_push($errors,"Date of birth is required.");
    }
    if(empty($gender))
    {
      // echo "gen";
      array_push($errors,"Gender is required.");
    }

    if(count($errors)==0){
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = md5($password);
        $query1 = " select * from user where name = '$name' ";
        $result1 = mysqli_query($conn,$query1);
        $query2 = " select * from page where pname = '$name' ";
        $result2 = mysqli_query($conn,$query2);

        if(mysqli_num_rows($result1)==0 && mysqli_num_rows($result2)==0){
            $sql = "INSERT INTO user (name,email,ph_no,dob,gender, password) VALUES ('$name','$email','$ph_no','$dob','$gender','$hashed_password')";
            if(mysqli_query($conn,$sql)){
              redirect_to("index.php?registered=true");
            }
            else {
              echo "Error: " . $conn->error;
            }
        }
        else{
          array_push($errors, "The username already exists.");
          require_once "error.php";
        }       
    }
    else{
      require_once "error.php";
    }  
  }

  if(isset($_POST['register_page'])){
      $pname = $_POST["pname"];
      $admin_name = $_POST["admin_name"];
      $email = $_POST["email"];
      $ph_no = $_POST["ph_no"];
      $dob = $_POST["dob"];
      $gender = $_POST["gender"];
      $password = $_POST["password"];

    if(empty($admin_name))
    {
      array_push($errors, "Admin name is required.");
    }
    if(empty($pname))
    {
      array_push($errors, "Page name is required.");
    }
    if(empty($email))
    {
      array_push($errors, "Email is required.");
    }
    if(empty($ph_no))
    {
      array_push($errors, "Phone No. is required.");
    }
    if(empty($password))
    {
      array_push($errors, "Password is required.");
    }
    if(empty($dob))
    {
      array_push($errors,"Date of birth is required.");
    }
    if(empty($gender))
    {
      array_push($errors,"Gender is required.");
    }

    if(count($errors)==0){
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = md5($password);
        $query1 = " select * from user where name = '$pname' ";
        $result1 = mysqli_query($conn,$query1);
        $query2 = " select * from page where pname = '$pname' ";
        $result2 = mysqli_query($conn,$query2);

        if(mysqli_num_rows($result1)==0 && mysqli_num_rows($result2)==0){
            $sql = "INSERT INTO page (pname,admin_name,email,ph_no,dob,gender, password) VALUES ('$pname','$admin_name','$email','$ph_no','$dob','$gender','$hashed_password')";
            if(mysqli_query($conn,$sql)){
              redirect_to("index.php?registered=true");
            }
            else {
              echo "Error: " . $conn->error;
            }
        }
        else{
          array_push($errors, "The page name already exists.");
          require_once "error.php";
        }       
    } else{
      require_once "error.php";
    }   
  }  

  
  $conn->close();

  ?>
