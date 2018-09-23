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

          if (isset($_GET['category'])) {
            $post_category_id = $_GET['category'];
          }

           $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
           $select_all_from_posts_query = mysqli_query($connection, $query);
           $count = 0;
           while ($row = mysqli_fetch_assoc($select_all_from_posts_query)) {
            
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];  
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = substr(strip_tags($row['post_content']), 0, 200);
              $post_status = $row['post_status'];
              if ($post_status != "published") {
                continue;
              } else {
              $count += 1;
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
          } 
         }

        if ($count == 0) {
          echo "<h1 class='text-center'>NO POSTS PUBLISHED!</h1>";
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
