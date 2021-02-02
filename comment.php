<?php 

	require_once "header.php";
	require_once "functions.php";
	db_connect();

	$creation_id = $_GET['creation_id'];
	$user  = $_SESSION['name'];

?>

<div class="col-md-6" style="margin-left: 25%;">

<div>
        <!-- post -->
        <?php 
          $sql = "SELECT * from user_post_creation inner join post on user_post_creation.post_id = post.post_id where post_creation_id = '$creation_id'

            UNION 
            SELECT * from (select post_creation_id,pname as name,post_id,post_creation_time,NULL as privacy,NULL as creation_type from page_post_creation) as user_post_creation inner join post on user_post_creation.post_id = post.post_id

            where post_creation_id = '$creation_id'

            "
          ;
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
              if($creation_type == NULL){
                $creation_type = "Posted";
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

                      $privacy = $post['privacy'];

                        if($privacy == NULL){
                $privacy = 'public';
              }
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
      <?php
       if($_SESSION['name'] != "") {
        ?>

      <div class="panel-body">
             <!-- comment form -->
      <form method="post" action="create_comment.php?creation_id=<?php echo $creation_id;  ?>" >
        <div class="input-group">
          <input class="form-control" type="text" name="content" placeholder="Make a Comment..." required>
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit" name="comment">Comment</button>
          </span>
        </div>
      </form><hr>
      <!-- ./comment form -->
    </div>

    <?php } ?>
      <?php 
      	$query3 = "SELECT * from comment where creation_id = '$creation_id'";
      	$result3 = mysqli_query($conn,$query3);
      	if(mysqli_num_rows($result3)){
      		while($row = mysqli_fetch_array($result3)){
      			$comment_content = $row['comment_content'];
				$commenter = $row['name'];
				?>
      			<div class="panel-footer">
              	<h4><?php echo $commenter; ?></h4>
              	<p><?php echo $comment_content; ?></p>
             
            	</div>
            	<?php 
      		}
      	}
      	else{?>
      		<div class="panel-footer">
              <h4><?php echo "No Comments yet"; ?></h4>
            </div>
		<?php
      	}
      ?>
	  	    		

  </div>
