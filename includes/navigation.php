
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <?php

              $query = "SELECT * FROM categories";
              $select_all_from_categories_query = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($select_all_from_categories_query)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                
                echo "<li class='nav-item active'>
              <a class='nav-link' href='category.php?category=$cat_id'>{$cat_title}
              </a>
            </li>";
              }
          
            ?>

             <li class="nav-item active">
              <a class="nav-link" href="admin/index.php">Admin
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="./registration.php">Register
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <?php 

            if (isset($_SESSION['user_role'])) {
              if (isset($_GET['p_id'])) {
                if (!isset($_GET['author'])) {
                    $the_post_id = $_GET['p_id'];
                    echo "<li class='nav-item active'>
                    <a class='nav-link' href='admin/pages/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post
                    </a>
                    </li>";
                }              
              }
            }

             ?>
          </ul>
        </div>
      </div>
    </nav>