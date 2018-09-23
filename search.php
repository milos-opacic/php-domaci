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

            if (isset($_POST['submit'])) {
              $search = $_POST['search'];
              $query = "SELECT * FROM  posts WHERE post_tags LIKE '%$search%'";
              $search_query = mysqli_query($connection, $query);
              if (!$search_query) {
                die("QUERY FAILED" . mysqli_error($connection));
              }

              $count = mysqli_num_rows($search_query);

              if($count == 0){
                echo "<h1>No result!</h1>";
              } else {

           while ($row = mysqli_fetch_assoc($search_query)) {
            
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
              <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post_date ?> by
              <a href="#"><?php echo $post_author ?></a>
            </div>
          </div>

      <?php     
                }
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
