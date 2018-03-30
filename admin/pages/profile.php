 <?php include "../includes/admin_header.php"; ?>

<?php 

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_profile_query = mysqli_query($connection, $query);
    confirm($select_user_profile_query);
    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {

      $user_id = $row['user_id'];
      $username = $row['username'];  
      $user_password_db = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];  
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

    }
}

 ?>


<?php 

if (isset($_POST['update_profile'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password_form = $_POST['user_password'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../../img/$user_image");  

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection, $query);
    // confirm($select_randsalt_query);
    // $row = mysqli_fetch_assoc($select_randsalt_query);
    // $salt = $row['randSalt'];

    if ($user_password_db == $user_password_form) {
        $hashed_password = $user_password_db;
    } else {
        $hashed_password = password_hash($user_password_form, PASSWORD_BCRYPT, array('cost' => 10));
    }
    

    $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', ";
    $query .= "username = '{$username}', user_email = '{$user_email}', user_password = '{$hashed_password}', user_image = '{$user_image}' ";
    $query .= "WHERE user_id = {$user_id}";

    $update_profile = mysqli_query($connection, $query);
    confirm($update_profile);


 }

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../includes/admin_navigation.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h1 class="page-header">Welcome to admin <small><?php echo $username; ?></small></h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php if (isset($_POST['update_profile'])) {
                                echo "Profile Updated";
                            } ?>
                            <div class="form-group">
                                <label for="post_author">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <label for="post_status">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_role">User role</label><br>
                                <select name="user_role" id="">
                                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

                        <?php 

                        if ($user_role == "admin") {
                        echo "<option value='subscriber'>subscriber</option>";
                        } else {
                        echo "<option value='admin'>admin</option>";
                        }


                        ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_image">User image</label>
                                <input type="file" name="user_image" value="<?php echo $user_image ?>">
                            </div>
                            <div class="form-group">
                                <label for="post_tags">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                            </div>
                             <div class="form-group">
                                <label for="post_content">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                             </div>
                                 <div class="form-group">
                                 <label for="post_content">Password</label>
                                 <input type="password" class="form-control" name="user_password" value="<?php echo $user_password_db ?>">
                             </div>

                             <div class="form-group"> 
                                 <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                             </div>
                        </form> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "../includes/admin_footer.php"; ?>
