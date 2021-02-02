<?php require_once "functions.php"; ?>
<?php include "header.php"; ?>
<?php 
    check_auth();
    db_connect();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Social Hub</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <div style = "width: 500px;margin-left : 30%;">
   <h2>Add a story</h2>
      <!-- post form -->
      <form method="post" action="create-story.php" enctype="multipart/form-data">
            <div class="form-group">
              <input class="form-control" type="text" name="heading" placeholder="Heading" value="">
            </div>

            <div class="form-group">
              <input class="form-control" type="text" name="text" placeholder="Text" value="">
            </div>

            

            <div class="form-group">
              <input class="" type="file" name="image" id = "image" placeholder="Image" value="">
            </div>

            <div class="form-group">
              <input class="btn btn-primary" type="submit" name = "make_story" value="Post">
            </div>
          </form><hr> 
  </div>
   
</body>


<?php  


  if(isset($_POST['make_story'])){
      db_connect();

      $check = getimagesize($_FILES['image']['tmp_name']);
      
      $image = $_FILES['image']['tmp_name'];
      $imgcontent = addslashes(file_get_contents($image));

      $text = $_POST['text'];
      $heading = $_POST['heading'];
      

      $story_id  = bin2hex(random_bytes(40));
      $start_time = date("Y-m-d H:i:s");

      $sql = "INSERT INTO story VALUES ('$story_id','$text','$heading','$imgcontent','$start_time')";

      if (mysqli_query($conn,$sql)) {
         redirect_to("story_creation.php?story_id=".$story_id);
      } else {
        echo "Error: " . $conn->error;
      }

  }
  

?>