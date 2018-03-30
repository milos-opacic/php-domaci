 <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <form action="search.php" method="post">     
            <div class="card-body">
              <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button name="submit" class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </div>
            </div>
            </form>
          </div>

          <!-- Login -->
          <div class="card my-4">
           <div class="login-panel panel panel-default">
                    <div class="card-header">
                        <h5 class="panel-title">Sign In</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="includes/login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" name="login" type="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <?php
              $query = "SELECT * FROM categories";
              $select_categories_sidebar = mysqli_query($connection, $query);
            ?>
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php 
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                         $cat_title = $row['cat_title'];
                         $cat_id = $row['cat_id'];

                         echo " <li>
                      <a href='category.php?category=$cat_id'>{$cat_title}</a>
                    </li>";
                        }
                     ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>