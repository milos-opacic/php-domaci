<?php include "../includes/admin_header.php"; ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "../includes/admin_navigation.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to admin <small><?php echo getUsername(); ?></small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 

                                    $query = "SELECT * FROM posts";
                                    $selec_all_posts = mysqli_query($connection, $query);
                                    confirm($selec_all_posts);
                                    $post_count = mysqli_num_rows($selec_all_posts);
                                    echo " <div class='huge'>{$post_count}</div>";

                                     ?>
                                   
                                    <div><b>Posts</b></div>
                                </div>
                            </div>
                        </div>
                        <a href="./posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 

                                    $query = "SELECT * FROM comments";
                                    $selec_all_comments = mysqli_query($connection, $query);
                                    confirm($selec_all_comments);
                                    $comment_count = mysqli_num_rows($selec_all_comments);
                                    echo " <div class='huge'>{$comment_count}</div>";

                                     ?>
                                    <div><b>Comments</b></div>
                                </div>
                            </div>
                        </div>
                        <a href="./comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 

                                    $query = "SELECT * FROM users";
                                    $selec_all_users = mysqli_query($connection, $query);
                                    confirm($selec_all_users);
                                    $user_count = mysqli_num_rows($selec_all_users);
                                    echo " <div class='huge'>{$user_count}</div>";

                                     ?>
                                    <div><b>Users</b></div>
                                </div>
                            </div>
                        </div>
                        <a href="./users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 

                                    $query = "SELECT * FROM categories";
                                    $selec_all_categories = mysqli_query($connection, $query);
                                    confirm($selec_all_categories);
                                    $category_count = mysqli_num_rows($selec_all_categories);
                                    echo " <div class='huge'>{$category_count}</div>";

                                     ?>
                                    <div><b>Categories</b></div>
                                </div>
                            </div>
                        </div>
                        <a href="./categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php 

            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $selec_all_published_posts = mysqli_query($connection, $query);
            confirm($selec_all_published_posts);
            $post_published_count = mysqli_num_rows($selec_all_published_posts);

            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $selec_all_draft_posts = mysqli_query($connection, $query);
            confirm($selec_all_draft_posts);
            $post_draft_count = mysqli_num_rows($selec_all_draft_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $selec_all_unapproved_comments = mysqli_query($connection, $query);
            confirm($selec_all_unapproved_comments);
            $unapproved_comment_count = mysqli_num_rows($selec_all_unapproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $selec_all_subscribers = mysqli_query($connection, $query);
            confirm($selec_all_subscribers);
            $subsrciber_user_count = mysqli_num_rows($selec_all_subscribers);


             ?>
            <!-- /.row -->
            <div class="row">
                <script type="text/javascript">
                  google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Data', 'Count',],
                      <?php 

                      $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments','Unapproved Comments', 'Users', 'Subscribers', 'Categories'];
                      $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count,$unapproved_comment_count, $user_count,$subsrciber_user_count, $category_count];
                      for ($i = 0; $i < 7; $i++) {
                          echo "['{$element_text[$i]}', {$element_count[$i]}],";
                      }

                       ?>
                    ]);

                    var options = {
                      chart: {
                        title: '',
                        subtitle: '',
                      }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
                </script>
                 <div id="columnchart_material" style="width: 'auto'; height: 600px;"></div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "../includes/admin_footer.php"; ?>
