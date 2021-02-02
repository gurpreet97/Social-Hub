
<?php require_once "functions.php"; ?>
<?php include "header.php"; ?>

<?php
  check_auth();
  db_connect();
  $user = $_SESSION['name'];
?>

<!-- main -->



<main class="container">
  <!-- messages -->
  <?php if(isset($_GET['request_sent'])): ?>
    <div class="alert alert-success">
      <p>Friend request sent!</p>
    </div>
  <?php endif; ?>
  <!-- ./messages -->

  <div class="row">
    <div class="col-md-3">
      <!-- friend requests -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>friend requests</h4>
          <?php 
            $sql = "SELECT sent_by FROM friend_request WHERE sent_to = '$user'";
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result)) {
              ?><ul><?php
              while($f_request = $result->fetch_assoc()) {
                ?>
                <li>
                  
                  <a href="profile.php?name=<?php echo $f_request['sent_by']; ?>"><?php echo $f_request['sent_by']; ?></a> 
                  <a class="text-success" href="accept-request.php?uname=<?php echo $f_request['sent_by']; ?>">[accept]</a> 
                  <a class="text-danger" href="remove-request.php?uname=<?php echo $f_request['sent_by']; ?>">[decline]</a>
                </li>
                <?php
              } ?></ul><?php
            } else {
              ?>
                <p class="text-center">No friend requests!</p>
              <?php
            }
          ?>
        </div>
      </div>
      <!-- ./friend requests -->
    </div>
    <div class="col-md-6">
      <!-- <h4>Make a post</h4> -->
      <!-- post form -->
      <form method="post" action="create-post.php">
            <div class="form-group" style="margin-left: 35%;">
              <input class="btn btn-primary" type="submit" value="Make a Post">
            </div>
          </form><hr>
      <!-- ./post form -->


      <!-- feed -->
      <h2 style="margin-left: 35%">Home Feed</h2>
      <div>
        <!-- post -->
        <?php 
          $sql = "SELECT * from user_post_creation inner join post on user_post_creation.post_id = post.post_id where privacy = 'public' or (privacy = 'friends' and name in (select friend_name from have_friend where name = '$user' ) ) or name  = '$user' 

            UNION 

           ( SELECT * from (select post_creation_id,pname as name,post_id,post_creation_time,NULL as privacy,NULL as creation_type from page_post_creation) as user_post_creation inner join post on user_post_creation.post_id = post.post_id 
            where name in (select pname as name from user_like_page where name = '$user'))


          order by post_creation_time desc ";

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

              $creation_type = $post['creation_type'];
              $privacy = $post['privacy'];
              if($creation_type == NULL){
                $creation_type = 'Posted';
              }

              if($privacy == NULL){
                $privacy = 'public';
              }

              ?>
                <div class="panel panel-default">
            <div class="panel-footer">
              <span><?php echo $creation_type; ?> on <?php echo $post['post_creation_time']; ?> by <?php echo $post['name']; ?></span> 
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
                     $link1 = "post_creation.php?post_id=".$post['post_id']."&privacy=".$privacy."&creation_type=Shared";

                     $link2 = "delete-post.php?creation_id=".$post['post_creation_id'];

                     $link3 = "post_creation.php?post_id=".$post['post_id']."&privacy=".$privacy."&creation_type=Posted";

                      if($_SESSION['name'] != "") {
               
               if($post['name']==$user){
               ?>

              <span class="pull-right"><a class="text-danger" style = "padding: 5px" href="<?php echo $link2; ?>">  delete  </a></span>
            <?php } 
               if($post['name']!=$user){
            ?>

             <span class="pull-right"><a class="text-secondary" style = "padding: 5px" href="<?php echo $link3; ?>">Copy
                  </a></span>
              <span class="pull-right"><a class="text-secondary" style = "padding: 5px" href="<?php echo $link1; ?>">Share
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
              </a></span>

             

            <?php } ?>
              <span class="pull-right"><a class="text-secondary" style = "padding: 5px" href=<?php     echo "comment.php?creation_id=".$creation_id; ?>>  comment  </a></span>
              <span class="pull-right"><a class="text-primary" style = "padding: 5px" href= <?php     echo "like_post.php?creation_id=".$creation_id; ?> > 
              <?php  
                  $query5 = "SELECT * from like_post where creation_id = '$creation_id' and name = '$user' ";
                  $result5 = mysqli_query($conn,$query5);
                  if(mysqli_num_rows($result5)==0){
                   echo 'like';
                  }
                  else{
                    echo 'unlike';
                  }
                ?>   
                </a></span>

              <?php }?>

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
      <!-- ./feed -->
    </div>
    <div class="col-md-3">
    <!-- add friend -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>add friend</h4>
          <?php 

            $sql = "SELECT user.name from user where name not in (select friend_name from have_friend where have_friend.name = '$user' union select sent_by from friend_request where sent_to = '$user' union select sent_to from friend_request where sent_by = '$user') and user.name != '$user'";

            // $sql = "SELECT id, username, (SELECT COUNT(*) FROM friends WHERE friends.user_id = users.id AND friends.friend_id = {$_SESSION['user_id']}) AS is_friend FROM users WHERE id != {$_SESSION['user_id']} HAVING is_friend = 0";

            $result = mysqli_query($conn,$sql);

            if ($result->num_rows > 0) {
              ?><ul><?php
              while($af_user = $result->fetch_assoc()) {
                ?>
                <li>
                  <a href="profile.php?name=<?php echo $af_user['name']; ?>">
                    <?php echo $af_user['name']; ?>
                  </a> 
                  <a href="add-friend.php?uname=<?php echo $af_user['name']; ?>">[add]</a>
                </li>
                <?php
              }
              ?></ul><?php
            } else {
              ?>
                <p class="text-center">No users to add!</p>
              <?php
            }
          ?>
        </div>
      </div>
      <!-- ./add friend -->
    </div>

    <div class="col-md-3">
    <!-- like page -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>like page</h4>
          <?php 

            $sql2 = "SELECT pname from page where pname not in (select pname from user_like_page where name = '$user') ";

            // $sql = "SELECT id, username, (SELECT COUNT(*) FROM friends WHERE friends.user_id = users.id AND friends.friend_id = {$_SESSION['user_id']}) AS is_friend FROM users WHERE id != {$_SESSION['user_id']} HAVING is_friend = 0";

            $result2 = mysqli_query($conn,$sql2);

            if ($result2->num_rows > 0) {
              ?><ul><?php
              while($af_page = $result2->fetch_assoc()) {
                ?>
                <li>
                  <a href="page_profile.php?pname=<?php echo $af_page['pname']; ?>">
                    <?php echo $af_page['pname']; ?>
                  </a> 
                  <a href="like_page.php?pname=<?php echo $af_page['pname']; ?>">[like]</a>
                </li>
                <?php
              }
              ?></ul><?php
            } else {
              ?>
                <p class="text-center">No pages to like!</p>
              <?php
            }
          ?>
        </div>
      </div>
      <!-- ./like page -->
    </div>
  </div>
</main>
<!-- ./main -->

<?php include "footer.php"; ?>