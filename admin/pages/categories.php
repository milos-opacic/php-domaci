<?php include "../includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../includes/admin_navigation.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to admin <small> <?php echo getUsername(); ?></small></h1>
                    <div class="col-xs-6">

                <?php insert_categories(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php // UPDATE AND INCLUDE QUERY

                        if (isset($_GET['update'])) {
                            $cat_id = $_GET['update'];
                            include "../includes/edit_categories.php";
                        }


                         ?>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
<?php findAllCategories(); ?>

<?php deleteCategories(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "../includes/admin_footer.php"; ?>
