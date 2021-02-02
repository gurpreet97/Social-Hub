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
   <h2>Make a post</h2>
      <!-- post form -->
      <form method="post" action="create-post-page.php" enctype="multipart/form-data">
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
              <input class="btn btn-primary" type="submit" name = "make_post" value="Post">
            </div>
          </form><hr> 
  </div>
   
</body>


<?php  


  if(isset($_POST['make_post'])){
      db_connect();

      $check = getimagesize($_FILES['image']['tmp_name']);
      
      $image = $_FILES['image']['tmp_name'];
      $imgcontent = addslashes(file_get_contents($image));

      $text = $_POST['text'];
      $heading = $_POST['heading'];
     

      $post_id  = bin2hex(random_bytes(40));

      $sql = "INSERT INTO post VALUES ('$post_id','$text','$heading','$imgcontent')";

      if (mysqli_query($conn,$sql)) {
         redirect_to("post_creation_page.php?post_id=".$post_id."&creation_type=posted");
      } else {
        echo "Error: " . $conn->error;
      }

  }
  

?>