<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
             <h1 class="my-4">Cryptocurrencies
              <small>expansion</small>
             </h1>
 
          <?php 

          	if (isset($_GET['p_id'])) {
          		$the_post_id = $_GET['p_id'];
              $the_post_author = $_GET['author'];

          	}

           $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
           $select_all_from_posts_query = mysqli_query($connection, $query);
           echo "<h2>All posts by {$the_post_author}</h2>";
           while ($row = mysqli_fetch_assoc($select_all_from_posts_query)) {

              $post_title = $row['post_title'];
              $post_author = $row['post_author'];  
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_id = $row['post_id'];

           ?>
       
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="img/<?php echo $post_image ?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post_title ?></h2>
              <p class="card-text"><?php echo $post_content ?></p>
              <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary">Read More And Comment &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post_date ?> by
              <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
            </div>
          </div>
          <?php 

          $query = "SELECT post_comment_count FROM posts WHERE post_id = {$post_id}";
          $query1 = "SELECT comment_status FROM comments WHERE comment_post_id = {$post_id}";
          $select_comment_query = mysqli_query($connection, $query1);
          confirm($select_comment_query);
          $select_post_query = mysqli_query($connection, $query);
          confirm($select_post_query);
          if (mysqli_fetch_assoc($select_post_query)['post_comment_count'] != 0 && mysqli_fetch_assoc($select_comment_query)['comment_status'] != "unapproved") {
            echo "<h4>Comments</h4>";
          }
           ?>

      <?php 

        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
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

      <?php 
            }
        }
      
        ?>


        </div>

        <!-- Sidebar Widgets Column -->
       <?php include "includes/sidebar.php"; ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
   <!-- Footer -->
 <?php include "includes/footer.php"; ?>
