<?php require_once "functions.php"; ?>
<?php include "header.php"; ?>




<?php
  check_auth();
  db_connect();
 
  $loggedin = $_SESSION['pname'];
  $page = $_GET['pname'];
  
  $sql = "SELECT * FROM page WHERE pname = '$page' ";

  $result = mysqli_query($conn,$sql);

  $row = mysqli_fetch_array($result);
  $admin_name = $row['admin_name'];
  $dob = $row['dob'];
  $gender = $row['gender'];
  $ph_no = $row['ph_no'];
  $email = $row['email'];
  
?>

<!-- main -->
<main class="container">
  <div class="row">
    <div class="col-md-3">

       <?php 
      if($page == $loggedin) {
        ?>
      <!-- edit profile -->
      <div class="panel panel-default">
        <div class="panel-body">
         <form method="post" action="create-story-page.php">
            <div class="form-group" style="margin-left: 20%;">
              <input class="btn btn-primary" type="submit" value="Add a new story">
            </div>
          </form>
          
        </div>
      </div>
      <!-- ./edit profile -->
    <?php } ?>

       <h2 style="margin-left: 20%"><?php echo $page ?>'s stories</h2>
      <!-- story -->
      <?php 

          $delsql1 = "DELETE from page_have_story where story_id in (select story_id from story where timediff(now(),start_time ) > '24:00:00') ";
          $delsql2 = "DELETE from story where timediff(now(),start_time ) > '24:00:00' ";

          mysqli_query($conn,$delsql1);
          mysqli_query($conn,$delsql2);

          $sql = "SELECT * from page_have_story inner join story on page_have_story.story_id = story.story_id where pname = '$page' order by start_time desc";

          $result = mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
            while($story = $result->fetch_assoc()) {
              
              ?>
                <div class="panel panel-default">
            <div class="panel-footer">
              <span>Added on <?php echo $story['start_time']; ?></span> 
            </div>
            <div class="panel-body">
              <h4><?php echo $story['story_heading']; ?></h4>
              <p><?php echo $story['story_text']; ?></p>
             <!--  <embed src='data:".$post['mime'].";base64,".base64_encode($post['post_image'])."' width='200'/> -->
              <!-- <embed src='data:".$post["mime"].";base64,".base64_encode($post["post_image"])."' width="200" /> -->
               <?php
                //header("Content-type: image/jpeg");
                //$data = $post['post_image'][0][0];
                // header("Content-Type: image/jpeg\n");
                // header("Content-Transfer-Encoding: binary\n");
                // header("Content-length: " . strlen($data) . "\n");
                // print($data);
                 //echo $post['post_image'];
               ?> 
              
              <img src="img/my_avatar.png" class="media-object" style="width: 128px; height: 100px;">
            </div>
            <div class="panel-footer" style = "height: 50px;">

               
            </div>
          </div>
              <?php
            }
          } else {
            ?>
              <p class="text-center">No stories yet!</p>
            <?php
          }
        ?>

        <!-- /story -->

    </div>
    <div class="col-md-6">
      <!-- user profile -->
      <div class="media">
        <div class="panel-footer">
        <div class="media-left">
          <img src="img/my_avatar.png" class="media-object" style="width: 128px; height: 128px;">
        </div>
        <div class="media-body">
          <h2 class="media-heading"><?php echo $page; ?></h2>
          <p>Admin Name: <?php echo $admin_name; ?> </p>
          
          <p>Email: <?php echo $email; ?> </p>
          
          <p>Admin's Gender: <?php echo $gender; ?> </p>
          
          <p>Phone Number: <?php echo $ph_no; ?> </p>
          
          <p>Date of Birth: <?php echo $dob; ?> </p>
          
        </div>

      </div>
      </div>
      <!-- user profile -->

      <hr>

       <!-- <h4>Make a post</h4> -->
      <!-- post form -->

      <?php 

      if($page == $loggedin) {

        ?>
      <form method="post" action="create-post-page.php">
            <div class="form-group" style="margin-left: 35%;">
              <input class="btn btn-primary" type="submit" value="Make a Post">
            </div>
          </form><hr>

        <?php } ?>
      <!-- ./post form -->

      <h2 style="margin-left: 40%">Timeline</h2>

      <!-- timeline -->
      <div>
        <!-- post -->
        <?php 
          $sql = "SELECT * from page_post_creation inner join post on page_post_creation.post_id = post.post_id where pname = '$page' order by post_creation_time desc";

          $result = mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
            while($post = $result->fetch_assoc()) {
              $creation_id = $post['post_creation_id'];
              $query1 = "SELECT count(*) as likes from like_post where creation_id = '$creation_id'";
              $num_likes1 = mysqli_query($conn,$query1);
              $num_likes = mysqli_fetch_array($num_likes1);

              $query2 = "SELECT count(*) as comments from comment where creation_id = '$creation_id'";
              $num_comm1 = mysqli_query($conn,$query2);
              $num_comm = mysqli_fetch_array($num_comm1);
              ?>
                <div class="panel panel-default">
            <div class="panel-footer">
              <span><?php echo 'posted' ; ?> on <?php echo $post['post_creation_time']; ?> by <?php echo $post['pname']; ?></span> 
            </div>
            <div class="panel-body">
              <h4><?php echo $post['post_heading']; ?></h4>
              <p><?php echo $post['post_text']; ?></p>
             <!--  <embed src='data:".$post['mime'].";base64,".base64_encode($post['post_image'])."' width='200'/> -->
              <!-- <embed src='data:".$post["mime"].";base64,".base64_encode($post["post_image"])."' width="200" /> -->
               <?php
                //header("Content-type: image/jpeg");
                //$data = $post['post_image'][0][0];
                // header("Content-Type: image/jpeg\n");
                // header("Content-Transfer-Encoding: binary\n");
                // header("Content-length: " . strlen($data) . "\n");
                // print($data);
                 //echo $post['post_image'];
               ?> 
              
              <img src="img/my_avatar.png" class="media-object" style="width: 128px; height: 100px;">
            </div>
            <div class="panel-footer" style = "height: 50px;">

              <?php
                 $likes = "likes.php?creation_id=".$creation_id;
               ?>

               <span class="pull-left"><a class="text-primary" style = "padding: 5px" href="<?php echo $likes; ?>">  
                <?php 
                  echo $num_likes['likes']." Likes";
                ?>
                </a></span>
               <span class="pull-left"><a class="text-secondary" style = "padding: 5px" href=<?php     echo "comment.php?creation_id=".$creation_id; ?>> 
                <?php 
                  echo $num_comm['comments']." Comments";
                ?>  
               </a></span>
               <?php 
                     
                     $link2 = "delete-page-post.php?creation_id=".$post['post_creation_id'];

               
               if($post['pname']==$loggedin){
               ?>

              <span class="pull-right"><a class="text-danger" style = "padding: 5px" href="<?php echo $link2; ?>">  delete  </a></span>
            <?php } 
              if($post['pname']!=$loggedin){
            ?>
              <!-- <span class="pull-right"><a class="text-secondary" style = "padding: 5px" href="<?php //echo $link1; ?>">Share -->
                <!-- <?php 
                  //   $link1 = "post_creation.php?post_id=".$post['post_id']."&privacy=public&creation_type=Shared";
                  //   $link2 = "post_creation.php?post_id=".$post['post_id']."&privacy=friend&creation_type=Shared";
                  //   $link3 = "post_creation.php?post_id=".$post['post_id']."&privacy=private&creation_type=Shared";
                  // ?>
 -->
                <!-- <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  Share
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php //echo $link1;  ?>  ">Public</a>
                  <a class="dropdown-item" href="<?php //echo $link2;  ?>">Only Friends</a>
                  <a class="dropdown-item" href="<?php //echo $link3;  ?>">Only me</a>
                </div>
              </div> -->
             <!--  </a></span> -->

            <?php } ?>
              

            </div>
          </div>
              <?php
            }
          } else {
            ?>
              <p class="text-center">No posts yet!</p>
            <?php
          }
        ?>
        <!-- ./post -->
      </div>
      <!-- ./timeline -->
    </div>
    <div class="col-md-3">
     
    </div>

     <div class="col-md-3">
      <!-- friends -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>Liked By</h4>
          <?php 
            $sql = "SELECT name FROM user_like_page WHERE pname = '$page'";
            $result = mysqli_query($conn,$sql);


            if (mysqli_num_rows($result) > 0) { ?>
              <ul>
                <?php
                  while($luser = $result->fetch_assoc()) { ?>
                    <li>
                     
                      <a href="profile.php?name=<?php echo $luser['name']; ?>"><?php echo $luser['name']; ?></a> 
                      
                    </li>
                <?php } ?>
              </ul>
            <?php } else { ?>
              <p class="text-center">No users</p>
            <?php } ?>
        </div>
      </div>
      <!-- ./friends -->
    </div>

  </div>


</main>
<!-- ./main -->

<?php include "footer.php" ?>



