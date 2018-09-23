<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
             <h1 class="my-4">Cryptocurrencies
              <small>blog</small>
             </h1>
 
          <?php 

        if (isset($_GET['p_id'])) {

           $the_post_id = $_GET['p_id'];
  
        	 $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id}";
           $send_query = mysqli_query($connection, $view_query);
           confirm($send_query);

           $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
           $select_all_from_posts_query = mysqli_query($connection, $query);
           while ($row = mysqli_fetch_assoc($select_all_from_posts_query)) {
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];  
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];

           ?>
       
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="img/<?php echo $post_image ?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post_title ?></h2>
              <p class="card-text"><?php echo $post_content ?></p>
              <a href="post.php?p_id=<?php echo $the_post_id; ?>" class="btn btn-primary">Read More And Comment &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post_date ?> by
              <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author ?></a>
            </div>
          </div>

      <?php }

} else {
  header("Location: index.php");
}
       ?>


      <?php 

      if (isset($_POST['create_comment'])) {
        $the_post_id = $_GET['p_id'];    

        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

            $create_comment_query = mysqli_query($connection, $query);
            confirm($create_comment_query);

            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
            // $update_comment_count = mysqli_query($connection, $query);
        } else {
          echo "<script>alert('Fileds cannot be empty!')</script>";
        }

        
      }


       ?>

      <div class="well">
      	<h4>Leave a Comment:</h4>
      	<form role="form" action="" method="post">
          <div class="form-group">
            <label for="comment_author">Author</label>
            <input class="form-control" type="text" name="comment_author">
          </div>
          <div class="form-group">
            <label for="comment_email">Email</label>
            <input class="form-control" type="email" name="comment_email">
          </div>
      		<div class="form-group">
            <label>Your Comment</label>
      			<textarea name="comment_content" class="form-control" rows="3"></textarea>
      		</div>
      		<button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
      	</form>
      </div>

      <hr>

      <?php 

      $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
      $select_comment_query = mysqli_query($connection, $query);
      confirm($select_comment_query);
      while ($row = mysqli_fetch_assoc($select_comment_query)) {
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        ?>

             <div class="media">
                <a class="pull-left" href="#">
                  <img src="http://placehold.it/64x64" alt="" class="media-object">
                </a>
                <div class="media-body">
                  <h4 class="media-heading">&nbsp;<?php echo $comment_author; ?>
                    <small><?php echo $comment_date; ?></small>
                  </h4>
                   &nbsp; <?php echo $comment_content; ?>
                </div>
              </div><br>



     <?php } ?>

          

        </div>

        <!-- Sidebar Widgets Column -->
       <?php include "includes/sidebar.php"; ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
   <!-- Footer -->
 <?php include "includes/footer.php"; ?>
