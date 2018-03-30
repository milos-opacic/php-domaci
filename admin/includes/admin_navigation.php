 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../pages/index.php">CMS Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>Users online: <?php echo usersOnline(); ?></li>
                <li><a href="../../index.php">Home site</a></li>
                <?php 
                $query = "SELECT username FROM users WHERE user_id = {$_SESSION['user_id']}";
                $select_username_query = mysqli_query($connection, $query);
                confirm($select_username_query);
                $username = mysqli_fetch_assoc($select_username_query)['username'];
                 ?> 
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../pages/profile.php"><i class="fa fa-user fa-fw"></i><?php echo $username; ?></a>
                        <li class="divider"></li>
                        <li><a href="../../includes/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../pages/index.php"><i class="fa fa-bar-chart-o"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="../pages/categories.php"><i class="fa fa-list"></i> Categories</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text"></i> Posts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../pages/posts.php">View All Posts</a>
                                </li>
                                <li>
                                    <a href="../pages/posts.php?source=add_post">Add Post</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../pages/users.php">View All Users</a>
                                </li>
                                <li>
                                    <a href="../pages/users.php?source=add_user">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="../pages/comments.php?source=view_all_comments"><i class="fa fa-comments"></i> Comments</a>

                        </li>
                        <li>
                            <a href="../pages/profile.php"><i class="fa fa-user"></i> Profile</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>