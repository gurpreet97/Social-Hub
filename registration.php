
<?php require_once "create_account.php" ?>

<!DOCTYPE html>
<html>
<head>
  <title>Social Hub</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <!-- nav -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.html">Social Hub</a>
      </div>
    </div>
  </nav>
  <!-- ./nav -->

  <!-- main -->
  <main class="container">
    <div style="align-content: center;margin-bottom: 50px">
  <h1 class="text-center" style = "border:2px solid hsl(0,80%,40%); border-radius:100px;width:500px;margin-left: 330px">Welcome to Social Hub! <br><small>A simple social media interface.</small></h1>
  </div>

    <div class="row">
      <div class="col-md-6" >
       <h3 ><b>Registration for User</b></h3>
        <br>

        <form method="post" action="create_account.php">
          <div class="form-group">
            <label >Username</label>
            <input class="form-control" type="text" name="name" placeholder="Username" value="<?php echo $name; ?>">
          </div>

           <div class="form-group">
             <label >Email</label>
            <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
          </div>

           <div class="form-group">
             <label >Phone Number</label>
            <input class="form-control" type="text" name="ph_no" placeholder="Phone Number" value="<?php echo $ph_no; ?>">
          </div>

           <div class="form-group">
             <label >Date of Birth</label>
            <input class="form-control" type="date" name="dob" placeholder="Date of Birth" value="<?php echo $dob; ?>">
          </div>

           <div class="form-group">
             <label >Gender</label>
            <input class="form-control" type="text" name="gender" placeholder="Gender" value="<?php echo $gender; ?>">
          </div>


          <div class="form-group">
             <label >Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>

         
         

          <div class="form-group">
            <input class="btn btn-primary" style = "background-color: hsl(0,80%,40%);" type="submit" name="register_user" value="Register">
          </div>
        </form>

        
        <!-- ./login form -->
      </div>
      <div class="col-md-6">
        <h3 ><b>Registration for Page</b></h3>
        <br>

        <!-- register form -->
         <form method="post" action="create_account.php">

          <div class="form-group">
            <label >Admin Name</label>
            <input class="form-control" type="text" name="admin_name" placeholder="Admin Name" value="<?php echo $admin_name; ?>">
          </div>

          <div class="form-group">
            <label >Page Name</label>
            <input class="form-control" type="text" name="pname" placeholder="Page Name" value="<?php echo $pname; ?>">
          </div>

           <div class="form-group">
             <label >Email</label>
            <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
          </div>

           <div class="form-group">
             <label >Phone Number</label>
            <input class="form-control" type="text" name="ph_no" placeholder="Phone Number" value="<?php echo $ph_no; ?>">
          </div>

           <div class="form-group">
             <label >Date of Birth</label>
            <input class="form-control" type="date" name="dob" placeholder="Date of Birth" value="<?php echo $dob; ?>">
          </div>

           <div class="form-group">
             <label >Gender</label>
            <input class="form-control" type="text" name="gender" placeholder="Gender" value="<?php echo $gender; ?>">
          </div>


          <div class="form-group">
             <label >Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>

          <div class="form-group">
            <input  class="btn btn-success" style = "background-color: hsl(0,80%,40%);" type="submit" name="register_page" value="Register">
          </div>
        </form>
        <!-- ./register form -->
      </div>
    </div>
   



            
    </div>
  </main>
  <!-- ./main -->

  <!-- footer -->
  <footer class="container text-center">
    <ul class="nav nav-pills pull-right">
      <li>Social Hub - Made by Ravi and Gurpreet</li>
    </ul>
  </footer>
  <!-- ./footer -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
