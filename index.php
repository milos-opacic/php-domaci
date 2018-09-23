<?php include "includes/header.php"; ?>



    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
             <h1 class="my-4">Cryptocurrency
              <small>blog</small>
             </h1>
          <?php 

           $per_page = 5;
           if (isset($_GET['page'])) {
             $page = $_GET['page'];
           } else {
             $page = "";
           }

           if ($page == "" || $page == 1) {
             $page_1 = 0;
           } else {
             $page_1 = ($page * $per_page) - $per_page;
           }

           $post_query_count = "SELECT * FROM posts";
           $find_count = mysqli_query($connection, $post_query_count);
           confirm($find_count);
           $post_count = mysqli_num_rows($find_count);
           $post_count = ceil($post_count / $per_page);

           $query = "SELECT * FROM posts ORDER BY post_date DESC LIMIT $page_1, $per_page";
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
            <img class="card-img-top" src="img/<?php echo $post_image; ?>" alt="Card image cap">
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
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <?php 

            for ($i=1; $i <= $post_count; $i++) { 

                if ($i == $page) {
                  echo " <li class='page-item active'>
                            <a class='page link' href='index.php?page={$i}'>
                              <span class='page-link'>
                              {$i}
                             <span class='sr-only'>(current)</span>
                            </span>
                            </a>
                         </li>";
                } else {
                  echo " <li class='page-item'>
                            <a class='page-link' href='index.php?page={$i}'>{$i}</a>
                         </li>";
                }
            }

             ?>
        </ul>

        </div>

        <!-- Sidebar Widgets Column -->
       <?php include "includes/sidebar.php"; ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
   <!-- Footer -->
 <?php include "includes/footer.php"; ?>
